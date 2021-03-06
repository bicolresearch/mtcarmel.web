<?php

/*
    Filename    : Media.php
    Location    : application/controllers/admin/Media.php
    Purpose     : Media controller
    Created     : 07/11/2019 17:03:40 by Spiderman
    Updated     : 09/16/2019 19:02:28 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Media extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Media Manager',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/media.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function media() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        // Create a client with a base URI
        $client = $this->guzzle->client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-API-KEY' => $this->guzzle->key()
            ],
            'query' => [
                'branch_id' => $_GET['branch_id']
            ]
        ];

        try {
            // GET request
            $response = $client->get('media', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // GET request
    public function medium() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        // Create a client with a base URI
        $client = $this->guzzle->client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-API-KEY' => $this->guzzle->key()
            ],
            'query' => [
                'branch_id' => $_GET['branch_id'],
                'id' => $_GET['id']
            ]
        ];

        try {
            // GET request
            $response = $client->get('media/medium', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // POST request
    public function create() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $this->form_validation
            ->set_rules('name', 'Name', 'trim|required|xss_clean')
            ->set_rules('description', 'Description', 'trim|required|xss_clean')
            ->set_error_delimiters('<li>', '</li>');
        if(empty($_FILES['userfile']['name'])){
            $this->form_validation->set_rules('userfile', 'File Upload', 'required');
        }

        if ($this->form_validation->run()) {

            if (!empty($_FILES['userfile']['name'])) {
                
                $this->_set_upload_config('bmp|jpg|gif|png', 10240, 0, 0);

                if ($this->upload->do_upload('userfile')) {

                    $data = $this->upload->data();

                    // Create a client with a base URI
                    $client = $this->guzzle->client();
        
                    $options = [
                        'headers' => [
                            'Content-Type' => 'application/x-www-form-urlencoded',
                            'X-API-KEY' => $this->guzzle->key()
                        ],
                        'form_params' => [
                            'branch_id' => $this->config->item('branch_id'),
                            'name' => $this->input->post('name'),
                            'description' => $this->input->post('description'),
                            'file_name' => $data['file_name'],
                            'file_type' => $data['file_type'],
                            'file_ext' => $data['file_ext'],
                            'file_size' => $data['file_size'],
                            'file_path' => 'public/assets/uploads/',
                            'full_path' => 'public/assets/uploads/' . $data['file_name'],
                            'base64' => $this->image_to_base64($data['file_type'], $data['full_path']),
                            'user_id' => user('id')
                        ]
                    ];

                    try {
                        // POST request
                        $response = $client->post('media/create', $options);
            
                        // Return $response  
                        echo $response->getBody()->getContents();

                        // Delete file after successfull upload
                        @unlink($data['full_path']);
                    }
                    catch (GuzzleHttp\Exception\ClientException $e) {
                        $response = $e->getResponse();
            
                        // Return $response 
                        echo $response->getBody()->getContents();
                    }
                } else {
                    $view_data = [
                        'status' => false,
                        'message' => $this->upload->display_errors('<li>', '</li>'),
                        'userfile' => form_error('userfile')
                    ];
                    echo json_encode($view_data);
                }
            }
        } else {
            $view_data = [
                'status' => false,
                'message' => validation_errors(),
                'name' => form_error('name'),
                'description' => form_error('description'),
                'userfile' => form_error('userfile')
            ];
            echo json_encode($view_data);
        }
    }

    // PUT request
    public function update() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $set_data = array(
            'name' => $this->input->put('name'),
            'description' => $this->input->put('description')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('name', 'name', 'trim|required|xss_clean')
            ->set_rules('description', 'description', 'trim|required|xss_clean')
            ->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run()) {

            // Create a client with a base URI
            $client = $this->guzzle->client();

            $options = [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'X-API-KEY' => $this->guzzle->key()
                ],
                'form_params' => [
                    'name' => $this->input->put('name'),
                    'description' => $this->input->put('description'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // Get the id parameter
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('media/update/id/' . $id, $options);

                // Return $response  
                echo $response->getBody()->getContents();
            }
            catch (GuzzleHttp\Exception\ClientException $e) {
                // Get $response
                $response = $e->getResponse();

                // Return $response 
                echo $response->getBody()->getContents();
            }
        } else {
            $view_data = [
                'status' => false,
                'message' => validation_errors(),
                'name' => form_error('name'),
                'description' => form_error('description')
            ];
            echo json_encode($view_data);
        }
    } 
    
    // PUT request
    public function delete() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
             redirect('auth', 'refresh');
        }

        // Create a client with a base URI
        $client = $this->guzzle->client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-API-KEY' => $this->guzzle->key()
            ],
            'form_params' => [
                'user_id' => user('id')
            ]
        ];
        
        try {
            // Get the id parameter
            $id = $this->uri->segment(5);

            // PUT request
            $response = $client->put('media/soft_delete/id/' . $id, $options);

            // Return $response  
            echo $response->getBody()->getContents();
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // TODO: This should be in the custom helper
    private function _set_upload_config($type, $max_size, $max_width, $max_height)
    {
        $config['upload_path']      = './public/assets/images/';
        $config['allowed_types']    = $type;
        $config['max_size']         = $max_size;
        $config['max_width']        = $max_width;
        $config['max_height']       = $max_height;
        $config['file_ext_tolower'] = TRUE;
        $config['overwrite']        = TRUE;
        $config['detect_mime']      = TRUE;
        $config['mod_mime_fix']     = TRUE;

        return $this->upload->initialize($config);
    }

    private function image_to_base64($file_type, $full_path) {
        return 'data:' . $file_type . ';base64,' . base64_encode(file_get_contents($full_path));
    }
}