<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NewReminder extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('New_reminder_model');
        $this->load->model('Staff_model');
    }

    public function index()
    {
        $list = $this->Staff_model->get();
        $data = [
            'title' => 'Reminder',
            'staff' => $list,
        ];
        $this->load->view('hrm/admin/reminder', $data);
    }

    public function get_data_reminder()
    {
        $list = $this->New_reminder_model->get_datatables();
        $data = array();
        $cr = $this->New_reminder_model->get_created_by_ids();

        $fullname = '';
        foreach ($cr as $c) {
            $fullname = $c['full_name'];
        }
        // $no = 1;
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->date;
            $row[] = $field->firstname . ' ' . $field->lastname;
            $row[] = $field->description;
            $row[] = $field->is_complete == 1 ? 'Completed' : 'Not Completed';
            $row[] = $fullname;

            $data[] = $row;
        }

        $output = array(
            "draw" => 1,
            "recordsTotal" => $this->New_reminder_model->count_all(),
            "recordsFiltered" => $this->New_reminder_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
