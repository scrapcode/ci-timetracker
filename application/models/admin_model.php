<?php if(!defined('BASEPATH')) exit('No direct access.');
/* Author: Cam Tyler
 * Desc: Admin Model
 */

class Admin_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    // Grab the user level from the database.
    // 0 = Banned
    // 1 = User / Employee
    // 2 = Administrator
    public function is_admin() {
        $username = $this->security->xss_clean($this->session->userdata('username'));
        $id = $this->security->xss_clean($this->session->userdata('id'));
        
        if(isset($username) && isset($id)) {
            // Prepare the statement
            $sql = "SELECT `level` FROM `users` WHERE `username`=? AND `id`=?";

            // Run the query, applying the values,
            // then get the level, all in one call.
            $level = $this->db->query($sql, array($username, $id))->row()->level;

            if($level > 1) {
                // User is an admin.
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }

        // If all else fails... You ain't no admin.
        return false;
    }
}

/* EOF models/admin_model.php */