<?php defined('BASEPATH') OR exit('No directo access.');
/* Author: Cam Tyler
 * Desc:   Login Model
 */
class Login_model extends CI_model {
    function __construct() {
        parent::__construct();
    }

    public function validate() {
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        // Prepare the query by specifying what the values
        // are that we're looking for:
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));

        // Call the query
        $query = $this->db->get('users');

        // If we find exactly one match. (Noone should have the same uname//pass)
        if($query->num_rows() == 1) {
            $row = $query->row();
            $data = array(
                'id'        => $row->id,
                'username'  => $row->username,
                'fname'     => $row->fname,
                'validated' => true,
            );

            // Sets the session with the data we tugged from the db.
            $this->session->set_userdata($data);
            return true;
        }

        return false;
    }
}
