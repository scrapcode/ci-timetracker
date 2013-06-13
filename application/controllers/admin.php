<?php if(!defined('BASEPATH')) exit('No direct access.');
/* Author: Cam Tyler
 * Desc: Admin Panel
 */

class Admin extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->is_admin();
    }

    /* Index - Parse options, construct $data then render the view.
     * These work arounds are so that iUI.js works correctly.
     * If we don't pass the $inside var and detect it in the view,
     * The headers will continually load via AJAX calls in iUI.\
     */
    public function index($data_in = false, $inside = false) {
        $data = array();
        if(isset($data_in) && is_array($data_in)) { $data = array_merge($data, $data_in); }
        if(isset($inside)) { $data['inside'] = 'true'; }

        $this->view->load('admin_view', $data);
    }

    /* This is how you call index from within the app to prevent
     * doubling of the header.
     */
    public function dashboard() {
        $this->index(false, true);
    }

    /* Get and return results from the model
     */
    private function is_admin() {
        $this->load->model('admin_model');
        return ($this->admin_model->is_admin() ? true : false);
    }
}

/* EOF controllers/admin.php */