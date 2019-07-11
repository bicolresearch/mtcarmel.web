<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authme Authentication Library
 *
 * @package Authentication
 * @category Libraries
 * @author Gilbert Pellegrom
 * @link http://dev7studios.com
 * @version 1.0
 */
class Authme
{

    private $CI;

    /**
     * Authme constructor.
     */
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->library('session');
        $this->CI->load->model('authme_model');
    }

    /**
     * @return mixed
     */
    public function logged_in()
    {
        return $this->CI->session->userdata('logged_in');
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username, $password)
    {
        $user = $this->CI->authme_model->_login($username, hash('sha512', $password));
        if ($user) {
            unset($user->password);
            $this->CI->session->set_userdata([
                'logged_in' => true,
                'user' => $user
            ]);
            $this->CI->authme_model->_update($user->id, [
                'updated_by' => $user->id,
                'dt_updated' => date('Y-m-d H:i:s')
            ]);
            return true;
        }

        return false;
    }

    /**
     * @param bool $redirect
     */
    public function logout($redirect = false)
    {
        $this->CI->session->sess_destroy();
        if ($redirect) {
            redirect($redirect, 'refresh');
        }
    }
}

/* End of file: authme.php */
/* Location: application/libraries/authme.php */