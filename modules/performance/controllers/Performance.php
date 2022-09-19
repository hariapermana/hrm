<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Performance extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('goals_model');
    }

    /* List all announcements */
    public function index()
    {
        if (!has_permission('performance', '', 'view')) {
            access_denied('performance');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data(module_views_path('performance', 'table'));
        }
        $this->app_scripts->add('circle-progress-js','assets/plugins/jquery-circle-progress/circle-progress.min.js');
        $data['title']                 = _l('goals_tracking');
        $this->load->view('manage', $data);
    }

    public function goal($id = '')
    {
        if (!has_permission('performance', '', 'view')) {
            access_denied('performance');
        }
        if ($this->input->post()) {
            if ($id == '') {
                if (!has_permission('performance', '', 'create')) {
                    access_denied('performance');
                }
                $id = $this->goals_model->add($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('goal')));
                    redirect(admin_url('performance/goal/' . $id));
                }
            } else {
                if (!has_permission('performance', '', 'edit')) {
                    access_denied('performance');
                }
                $success = $this->goals_model->update($this->input->post(), $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('goal')));
                }
                redirect(admin_url('performance/goal/' . $id));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('goal_lowercase'));
        } else {
            $data['goal']        = $this->goals_model->get($id);
            $data['achievement'] = $this->goals_model->calculate_goal_achievement($id);

            $title = _l('edit', _l('goal_lowercase'));
        }

        $this->load->model('staff_model');
        $data['members'] = $this->staff_model->get('', ['is_not_staff' => 0, 'active'=>1]);

        $this->load->model('contracts_model');
        $data['contract_types']        = $this->contracts_model->get_contract_types();
        $data['title']                 = $title;
        $this->app_scripts->add('circle-progress-js','assets/plugins/jquery-circle-progress/circle-progress.min.js');
        $this->load->view('goal', $data);
    }

    /* Delete announcement from database */
    public function delete($id)
    {
        if (!has_permission('performance', '', 'delete')) {
            access_denied('performance');
        }
        if (!$id) {
            redirect(admin_url('performance'));
        }
        $response = $this->goals_model->delete($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('goal')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('goal_lowercase')));
        }
        redirect(admin_url('performance'));
    }

    public function notify($id, $notify_type)
    {
        if (!has_permission('performance', '', 'edit') && !has_permission('goals', '', 'create')) {
            access_denied('performance');
        }
        if (!$id) {
            redirect(admin_url('performance'));
        }
        $success = $this->goals_model->notify_staff_members($id, $notify_type);
        if ($success) {
            set_alert('success', _l('goal_notify_staff_notified_manually_success'));
        } else {
            set_alert('warning', _l('goal_notify_staff_notified_manually_fail'));
        }
        redirect(admin_url('performance/goal/' . $id));
    }
}
