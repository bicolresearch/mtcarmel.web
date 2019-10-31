<?php

/*
    Filename    : 10/24/2019 21:12:46 by Spiderman
    Location    : application/controllers/admin/Contact.php
    Purpose     : Contact controller
    Created     : 07/23/2019 11:53:46 by Scarlet Witch
    Updated     : 10/24/2019 21:08:54 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Contact',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/contact.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function contact() 
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
            $response = $client->get('contact', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
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
            'description' => $this->input->put('description'),
            'address1' => $this->input->put('address1'),
            'address2' => $this->input->put('address2'),
            'city' => $this->input->put('city'),
            'province' => $this->input->put('province'),
            'country' => $this->input->put('country'),
            'landline' => $this->input->put('landline'),
            'mobile' => $this->input->put('mobile'),
            'email' => $this->input->put('email')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('name', 'Name', 'trim|required|xss_clean')
            ->set_rules('description', 'Description', 'trim|required|xss_clean')
            ->set_rules('address1', 'Address1', 'trim|required|xss_clean')
            ->set_rules('address2', 'Address2', 'trim|required|xss_clean')
            ->set_rules('city', 'City', 'trim|required|xss_clean')            
            ->set_rules('province', 'Province', 'trim|required|xss_clean')
            ->set_rules('country', 'Country', 'trim|required|xss_clean')
            ->set_rules('landline', 'Landline', 'trim|required|xss_clean')
            ->set_rules('mobile', 'Mobile', 'trim|required|xss_clean')
            ->set_rules('email', 'Email', 'trim|required|xss_clean')
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
                    'address1' => $this->input->put('address1'),
                    'address2' => $this->input->put('address2'),
                    'city' => $this->input->put('city'),
                    'province' => $this->input->put('province'),
                    'country' => $this->input->put('country'),
                    'landline' => $this->input->put('landline'),
                    'mobile' => $this->input->put('mobile'),
                    'email' => $this->input->put('email'),
                    'user_id' => user('id')
                ]
            ];

            try {
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('contact/update/id/' . $id, $options);

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
                'description' => form_error('description'),
                'address1' => form_error('address1'),
                'address2' => form_error('address2'),
                'city' => form_error('city'),
                'province' => form_error('province'),
                'country' => form_error('country'),
                'landline' => form_error('landline'),
                'mobile' => form_error('mobile'),
                'email' => form_error('email') 
            ];

            echo json_encode($view_data);
        }
    } 
}