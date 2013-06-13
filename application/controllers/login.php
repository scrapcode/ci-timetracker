<?php if( ! defined('BASEPATH')) exit('No direct access.');
/* Author: Cam Tyler
 * Desc:   Login Controller
 */

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    public function index($msg = false) {
        $data = array(
            'title'     => 'Login',
        );
        if($msg) { $data = array_merge($data, $msg); }
        $this->load->view('header');
        $this->load->view('login_view', $data); // Show the login form.
        $this->load->view('footer');
    }

    public function process() {
        $this->load->model('login_model');
        $result = $this->login_model->validate();
        if( ! $result) {
            $error = array('error' =>'Invalid credentials! Please try again.');
            $this->index($error);
        }
        else
        {
            redirect('/');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $message = array('message' => 'Logout successful!');
        $this->index($message);
    }
}

/* EOF controllers/login.php */
