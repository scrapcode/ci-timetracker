<?php defined('BASEPATH') OR exit('No direct access.');   

class TimeTrack extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->check_isvalidated();
    }

    /* Index
     */
    public function index($data_in = false, $inside_call = false)
    {
        $this->load->model('admin_model');
        $data = array(
            'title'     => 'TimeTrack',
            'user'      => $this->session->all_userdata(),
            'is_admin'  => $this->admin_model->is_admin(),
        );
        if($data_in) { $data = array_merge($data, $data_in); }
        if($inside_call) { $data = array_merge($data, array('inside' => true)); }
        //$this->load->view('header');
        $this->load->view('dashboard', $data);
        //$this->load->view('footer');
    }

    /* Call the dashboard with this after first load,
     * to set `inside` as true. Fixes header/footer
     * conflicts with iUI...
     */
    public function dashboard() {
        $this->index(false, true);
    }

    /* history()
     * Returns an array of clock history.
     */
    public function history() {
        $this->load->model('timetrack_model');
        $data = array('history' => $this->timetrack_model->history());
        $this->load->view('history_view', $data);
    }

    /* time_in()
     * Clocks a user in.
     */
    public function time_in()
    {
        $this->load->model('timetrack_model'); // Load the model

        $data = array(
            'title'     => 'Time in',
            'user'      => $this->session->all_userdata(),
        );

        $time_in = $this->timetrack_model->time_in();
        if(!isset($time_in['error'])) { // If there were no errors:
            $data = array_merge($data, $time_in);
            $this->index($data, true);
        }
        else
        {
            // Load the timetrack dashboard and display the error.
            $this->index($time_in, true);
        } 
    }

    /* time_out()
     * Clocks a user out.
     */
    public function time_out() {
        $this->load->model('timetrack_model');
        $data = array(
            'title'     => 'Time out',
            'user'      => $this->session->all_userdata(),
        );

        $time_out = $this->timetrack_model->time_out();
        if(!isset($time_out['error'])) { // If there were no errors:
            $data = array_merge($data, $time_out);
            $this->index($data, true);
        }
        else
        {
            // Load the timetrack dashboard and display the error.
            $this->index($time_out, true);
        } 

    }

    /* check_isvalidated()
     * Checks if a user is logged in. If not, send to login page.
     */
    private function check_isvalidated()
    {
        if( ! $this->session->userdata('validated')) {
            redirect('login');
        }
    }
}

/* EOF main.php */
