<?php 

/*
    Filename    : Authme.php
    Location    : application/libraries/Authme.php
    Purpose     : Authme authentication library with guzzle
    Created     : 06/28/2019 17:03:40 by Spiderman
    Updated     : 07/12/2019 17:36:15 by Spiderman
    Changes     : Implement guzzle in authme library
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authme
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('guzzle');
    }

    public function logged_in()
    {
        return $this->CI->session->userdata('logged_in');
    }

    public function login($username, $password)
    {
        // Redirect to home if not ajax request
        if (!$this->CI->input->is_ajax_request()) {
            redirect('home', 'refresh');
        }

        // Create a client with a base URI
        $client = $this->CI->guzzle->client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-API-KEY' => $this->CI->guzzle->key()
            ]
        ];

        try {
            // GET request
            $response = $client->get('auth/login/username/' . $username . '/password/' . hash('sha512', $password), $options);

            $user = json_decode($response->getBody()->getContents());

            if ($user) {
                unset($user->password);
                $this->CI->session->set_userdata([
                    'logged_in' => true,
                    'user' => $user
                ]);

                // TODO: Replace this with guzzle
                $this->CI->authme_model->_update($user->id, [
                    'updated_by' => $user->id,
                    'dt_updated' => date('Y-m-d H:i:s')
                ]);
                return true;
            }

            return false;

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    public function logout($redirect = false)
    {
        $this->CI->session->sess_destroy();
        if ($redirect) {
            redirect($redirect, 'refresh');
        }
    }
}