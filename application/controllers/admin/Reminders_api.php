<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";
 
use chriskacerguis\RestServer\RestController;

class Reminders_api extends RestController
{
    function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
    }

    public function index_post()
    {
        $dueDate = $_POST['dueDate'];
        $assignTo = $_POST['assignTo'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $type = $_POST['type'];
        $subject = $_POST['subject'];
        $desc = $_POST['desc'];
        $staffid = get_staff_user_id();

        $queryArr = array(
            'staff' => $staffid,
            'date' => $dueDate,
            'start_periode_date' => $fromDate,
            'end_periode_date' => $toDate,
            'assigned_to' => $assignTo,
            'subject' => $subject,
            'description' => $desc,
            'rel_type' => $type,
            'is_complete' => 0,
            'uniq_code' => $this->uniqCode()
        );

        $insert = $this->db->insert('tblreminders', $queryArr);

        if ($insert) {
            $data = [
                'status' => $staffid
            ];
        }

        $this->response($data, 200);      
    }

    private function uniqCode()
    {
        return substr(sha1(openssl_random_pseudo_bytes(20)), -0);
    }
}