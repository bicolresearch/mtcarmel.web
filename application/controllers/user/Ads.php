<?php

/*
    Filename    : Ads.php
    Location    : application/controllers/user/Ads.php
    Purpose     : Ads Controller
    Created     : 09/24/2019 14:16:45 by Spiderman
    Updated     : 09/26/2019 13:52:40 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Ads extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Ads',
                'page_subtitle' => '',
                'user' => user()
            ];
        
            $this->twig->display('user/ads/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function place_ad()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Place an Ad',
                'user' => user()
            ];
    
            $this->twig->display('user/ads/place_ad.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function ad_status()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Ad Status',
                'user' => user()
            ];
    
            $this->twig->display('user/ads/ad_status.html', $view_data);
        } else {
            redirect('auth', 'refresh');
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
            ->set_rules('branch_id', 'Branch', 'trim|required|xss_clean')
            ->set_rules('location_id', 'Location', 'trim|required|xss_clean')
            ->set_rules('brand_name', 'Brand Name', 'trim|required|xss_clean')
            ->set_rules('company_name', 'Company Name', 'trim|required|xss_clean')
            ->set_rules('description', 'Description', 'trim|required|xss_clean')
            ->set_rules('service_type_id', 'Product / Service Type', 'trim|required|xss_clean')
            ->set_rules('type_id', 'Ad Type', 'trim|required|xss_clean')
            ->set_rules('url', 'URL', 'trim|valid_url|xss_clean')
            ->set_rules('durations', 'Durations', 'trim|required|xss_clean')
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
                    'branch_id' => $this->input->put('branch_id'),
                    'brand_name' => $this->input->post('brand_name'),
                    'company_name' => $this->input->post('company_name'),
                    'description' => $this->input->post('description'),
                    'service_type_id' => $this->input->post('service_type_id'),
                    //'media_id' => $this->input->post('media_id'),
                    'type_id' => $this->input->post('type_id'),
                    'url' => $this->input->post('url'),
                    'durations' => $this->input->post('durations'),
                    'total' => $this->input->post('total'),
                    'expiration' => $this->input->post('expiration'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('ads/create', $options);
    
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
                'branch_id' => form_error('branch_id'),
                'location_id' => form_error('location_id'),
                'brand_name' => form_error('brand_name'),
                'company_name' => form_error('company_name'),
                'description' => form_error('description'),
                'service_type_id' => form_error('service_type_id'),
                'type_id' => form_error('type_id'),
                'url' => form_error('url'),
                'durations' => form_error('durations')
            ];
            echo json_encode($view_data);
        }
    }
}