<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authme Authentication Library
 *
 * @package Authentication
 * @category Libraries
 * @author Gilbert Pellegrom
 * @link http://dev7studios.com
 * @version 1.0
 */

class Authme {

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->library('session');
        $this->CI->load->model('authme_model');
    }

    public function logged_in()
    {
        return $this->CI->session->userdata('logged_in');
    }

    public function login($email, $password)
    {
        $user = $this->CI->authme_model->_get_user_by_email($email);
        $password = hash('sha512', $password);
        if($user){
            if($password){
                unset($user->password);
                $this->CI->session->set_userdata(array(
                    'logged_in' => true,
                    'user' => $user
                ));
                $this->CI->authme_model->_set_user_update($user->id, array('last_login' => date('Y-m-d H:i:s')));
                return true;
            }
        }

        return false;
    }

    public function logout($redirect = false)
    {
        $this->CI->session->sess_destroy();
        if($redirect){
            redirect($redirect, 'refresh');
        }
    }

    public function create_account($email, $password)
    {
        $user = $this->CI->authme_model->_get_user_by_email($email);
        if($user) return false;

        $password = hash('sha512', $password);
        $this->CI->authme_model->_set_user_create($email, $password);
        return true;
    }

    public function reset_password($user_id, $new_password)
    {
        $new_password = hash('sha512', $new_password);
        $this->CI->authme_model->_set_user_update($user_id, array('password' => $new_password));
    }

}

/* End of file: authme.php */
/* Location: application/libraries/authme.php */