<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Goals_api extends RestController
{
    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        parent::__construct();
    }

    public function index_post()
    {
        $status = $_POST['status'];
        $uniq_code = $_POST['uniq_code'];

        switch ($status) {
            case 'approved':
                $data = array(
                    'uniq_code' => $uniq_code,
                    'status' => $status,
                );
                $success = $this->db->insert('tblgoals_status', $data);

                if ($success) {
                    $this->response(array('msg' => $status), 200);
                }
                break;

            case 'sendback':
                $date = date('Y-m-d');
                $endDate = date('Y');

                $reminders = array(
                    'date' => $date,
                    'start_periode_date' => $date,
                    'end_periode_date' => $endDate,
                    'notify_by_email' => 1,
                    'subject' => 'Send Back the Goal',
                    'description' => $this->input->post('reason'),
                    'rel_type' => 'sendback',
                    'uniq_code' => $this->input->post('uniq_code'),
                    'assigned_to' => $this->input->post('to'),
                    'staff' => 1
                );

                $this->db->where('uniq_code', $uniq_code);
                $cStatus = $this->db->get('tblgoals_status');
                $this->db->reset_query();
                
                if ($cStatus->num_rows() > 0) {
                    $this->db->where('uniq_code', $uniq_code);
                    $uGoal = $this->db->update('tblgoals_status', array('status' => $status));
                } else {
                    $uGoal = $this->db->insert('tblgoals_status', array('uniq_code' => $uniq_code, 'status' => $status));
                }

                $uReminder = $this->db->insert('tblreminders', $reminders);

                if ($uGoal && $uReminder) {
                    $this->response(array('msg' => $status), 200);
                }
                break;

            case 'meet':
                $date = date('Y-m-d');
                $endDate = date('Y');

                $reminders = array(
                    'date' => $date,
                    'start_periode_date' => $date,
                    'end_periode_date' => $endDate,
                    'notify_by_email' => 1,
                    'subject' => 'The meeting was invited by Manager',
                    'description' => $this->input->post('desc'),
                    'rel_type' => 'meet',
                    'uniq_code' => $this->input->post('uniq_code'),
                    'assigned_to' => $this->input->post('to'),
                    'staff' => 1
                );

                $this->db->where('uniq_code', $uniq_code);
                $cStatus = $this->db->get('tblgoals_status');
                $this->db->reset_query();
                
                if ($cStatus->num_rows() > 0) {
                    $this->db->where('uniq_code', $uniq_code);
                    $uGoal = $this->db->update('tblgoals_status', array('status' => $status));
                } else {
                    $uGoal = $this->db->insert('tblgoals_status', array('uniq_code' => $uniq_code, 'status' => $status));
                }

                $uReminder = $this->db->insert('tblreminders', $reminders);

                if ($uGoal && $uReminder) {
                    $this->response(array('msg' => $status), 200);
                }
                break;

            default:
                $this->response(array('msg' => 'Invalid arguments'), 200);
                break;
        }
    }
}
