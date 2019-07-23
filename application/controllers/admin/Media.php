<?php

/*
    Filename    : Media.php
    Location    : application/controllers/admin/Media.php
    Purpose     : Media controller
    Created     : 07/11/2019 17:03:40 by Spiderman
    Updated     : 07/17/2019 22:36:37 by Spiderman
    Changes     : Fix avatar
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
                'page_title' => 'Media',
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
                'id' => $this->uri->segment(5)
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

        $config['upload_path']      = './public/assets/images/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['file_ext_tolower'] = TRUE;
        $config['max_size']         = 2048; // 2MB
        $config['remove_spaces']    = TRUE;
        $config['detect_mime']      = TRUE;
        $config['mod_mime_fix']     = TRUE;

        $this->load->library('upload', $config);

        // $this->form_validation
        //     ->set_rules('name', 'Name', 'trim|required|xss_clean')
        //     ->set_rules('description', 'Description', 'trim|required|xss_clean')
        //     ->set_error_delimiters('<li>', '</li>');

        if (!$this->upload->do_upload('userfile')) {

            $view_data = [
                'status' => false,
                'message' => $this->upload->display_errors(),
                'name' => form_error('name'),
                'description' => form_error('description'),
                'userfile' => form_error('userfile')
            ];
            echo json_encode($view_data);

            // // Create a client with a base URI
            // $client = $this->guzzle->client();

            // $options = [
            //     'headers' => [
            //         'Content-Type' => 'multipart/form-data',
            //         'X-API-KEY' => $this->guzzle->key()
            //     ],
            //     'multipart' => [
            //         [
            //             'branch_id' => 1,
            //             'name' => $this->input->post('name'),
            //             'description' => $this->input->post('description'),
            //             'user_id' => user('id'),
            //             'contents' => fopen($data['file_path'], 'r'),
            //             'file_name' => $this->upload->data('file_name')
            //         ]
            //     ]
            // ];

            // try {
            //     // POST request
            //     $response = $client->post('media/create', $options);  
    
            //     // Return $response  
            //     echo $response->getBody()->getContents();
            // }
            // catch (GuzzleHttp\Exception\ClientException $e) {
            //     $response = $e->getResponse();
    
            //     // Return $response 
            //     echo $response->getBody()->getContents();
            // }
        } else {
            echo json_encode(array('upload_data' => $this->upload->data()));
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
                    'branch_id' => 1,
                    'name' => $this->input->put('name'),
                    'description' => $this->input->put('description'),
                    'media_id' => 5,
                    'user_id' => user('id')
                ]
            ];

            try {

                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('media/update/id/' . $id, $options);

                // Return $response  
                echo $response->getBody()->getContents();
            }
            catch (GuzzleHttp\Exception\ClientException $e) {
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
}