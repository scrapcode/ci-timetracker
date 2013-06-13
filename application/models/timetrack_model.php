<?php if(!defined('BASEPATH')) exit('No direct access.');
/* Author: Cam Tyler
 * Desc:   TimeTrack Model
 * */

class Timetrack_model extends CI_Model {
    var $user = '';

    public function __construct() {
        parent::__construct();
        $this->user = $this->session->all_userdata();
    } 

    public function time_in() {
        if(!$this->user_is_clocked_in()) {
            // If the user is NOT clocked in, then proceed:
            $data = array(
                'userid' => $this->user['id'],
                'time_in' => time(),
            );
            $this->db->insert('activity', $data);
            return $data;
        }
        else
        {
            // If the user IS clocked in, throw an error:
            return array('error' => 'You\'re already clocked in.');
        }

        return array('error' => 'An error has occured.');
    }

    public function time_out() {
        // Checks if user is clocked in,
        // if so: clock 'em out.
        $aid = $this->user_is_clocked_in();
        if($aid !== false) {
            // User is clocked in... proceed:
            $data = array (
                'time_out'  => time(),
            );
            $this->db->where('id', $aid);
            $this->db->update('activity', $data);

            return $data;
        }
        else
        {
            // They aren't clocked in...
            return array('error' => 'You haven\'t clocked in yet.');
        }

        return array('error' => 'An error occured.');
    }

    // Check if there is time-in entry for the user
    // without a time-out associated.
    // If there is, return the activity id.
    private function user_is_clocked_in() {
        $this->db->where('userid', $this->user['id']);
        $this->db->where('time_in !=', '');
        $this->db->where('time_out', '');
        $this->db->limit(1);

        $query = $this->db->get('activity');
        if($query->num_rows() > 0) {
            // This user is clocked in.
            return $query->row('id');
        }
        else
        {
            return false;
        }
    }

    // Gets clock history
    public function history($amount = 10) {
        $this->db->where('userid', $this->user['id']);
        $this->db->order_by('id', 'desc');
        $this->db->limit($amount);

        $query = $this->db->get('activity');
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = array(
                    'time_in' => $row->time_in,
                    'time_out'=> $row->time_out,
                );
            }

            return $data;
        }
        else
        {
            return array('error' => 'You have no history yet.');
        }
    }
}

/* EOF models/timetrack_model.php */
