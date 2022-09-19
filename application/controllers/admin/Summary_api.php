<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Summary_api extends RestController
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
        $requestType = $_POST['requestType'];

        switch ($requestType) {
            case 'approve':
                $uniqCode = $_POST['uniqCode'];

                $this->db->where('uniq_code', $uniqCode);
                $getTempGoals = $this->db->get('tbltemp_goals')->result();

                $tempData = array();
                foreach ($getTempGoals as $temp) {
                    $tempData[] = array(
                        'uniq_code' => $uniqCode,
                        'subject' => $temp->subject,
                        'strategy' => $temp->strategy,
                        'description' => $temp->description,
                        'weight' => $temp->weight,
                        'target' => $temp->target,
                        'start_date' => $temp->start_date,
                        'end_date' => $temp->end_date,
                        'staff_id' => get_staff_user_id()
                    );
                }

                $save = $this->db->insert_batch('tblgoals', $tempData);

                if ($save) {
                    $remove = $this->db->delete('tbltemp_goals', array('uniq_code' => $uniqCode));

                    if ($remove) {
                        $this->response('success', 200);
                    }
                }

                break;

            case 'temp':
                $uniqCode = explode(',', $_POST['uniqCode']);
                $sasa = explode(',', $_POST['sasaran']);
                $kpi = explode(',', $_POST['kpi']);
                $bobot = explode(',', $_POST['bobot']);
                $target = explode(',', $_POST['target']);
                $dueDate = explode(',', $_POST['dueDate']);

                $data = array();
                foreach ($sasa as $key => $s) {
                    $data[] = array(
                        'uniq_code' => $uniqCode[0],
                        'subject' => $s,
                        'strategy' => $s,
                        'description' => $kpi[$key],
                        'weight' => $bobot[$key],
                        'target' => $target[$key],
                        'start_date' => date('Y-m-d'),
                        'end_date' => $dueDate[$key],
                        'staff_id' => get_staff_user_id()
                    );
                }

                $insert = $this->db->insert_batch('tbltemp_goals', $data);
                if ($insert) {
                    $this->response('success', 200);
                }
                break;

            case 'delete':
                $uniqCode = $_POST['uniqCode'];

                $this->db->where('uniq_code', $uniqCode);
                $delete = $this->db->delete('tbltemp_goals');

                if ($delete) {
                    $this->response('success', 200);
                }
                break;

            case 'draft':
                $uniqCode = $_POST['uniqCode'];

                $data = [
                    'uniq_code' => $uniqCode,
                    'description' => 'Have drafted goals',
                    'date' => date('Y-m-d'),
                    'staffid' => get_staff_user_id(),
                    'full_name' => get_staff_full_name(),
                ];

                $draft = $this->db->insert('tblreminder_activity', $data);

                if ($draft) {
                    $this->response('success', 200);
                }
                break;

            default:
                $this->response('Invaled request', 404);
                break;
        }
    }
}
