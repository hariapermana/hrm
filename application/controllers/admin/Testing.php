<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Testing extends AdminController
{
    public function index()
    {
        $this->db->where('assigned_to', get_staff_user_id());
        $this->db->order_by('id', 'DESC');
        $data['reminds'] = $this->db->get('tblreminders')->result();

        $this->load->view('hrm/index', $data);
    }

    public function inbox()
    {
        $this->db->where('assigned_to', get_staff_user_id());
        $data['reminders'] = $this->db->get('tblreminders')->result();

        $this->db->where('staffid', get_staff_user_id());
        $data['history'] = $this->db->get('tblreminder_activity')->result();

        $this->load->view('hrm/inbox', $data);
    }

    public function detail_inbox($codeUniq)
    {
        $this->db->where('assigned_to', get_staff_user_id());
        $this->db->order_by('id', 'DESC');
        $data['reminders'] = $this->db->get('tblreminders')->result();

        $this->db->where('uniq_code', $codeUniq);
        $data['detailReminder'] = $this->db->get('tblreminders')->result();

        $this->db->where('uniq_code', $codeUniq);
        $data['goalsExist'] = $this->db->get('tblgoals')->result();

        $this->db->where('staffid', get_staff_user_id());
        $data['history'] = $this->db->get('tblreminder_activity')->result();

        $this->load->view('hrm/inbox', $data);
    }

    public function goals($uniqCode)
    {
        $this->db->where('uniq_code', $uniqCode);
        $this->db->from('tbltemp_goals');
        $goals = $this->db->get()->result();

        if ($goals[0] != '') {
            $data = [
                'codeUniq' => $uniqCode,
                'goals' => $goals,
            ];
        } else {
            $data = [
                'uCode' => $uniqCode
            ];
        }

        $this->load->view('hrm/goals', $data);

    }

    public function updateGoals($codeUniq)
    {
        $this->db->where('uniq_code', $codeUniq);
        $this->db->from('tbltemp_goals');
        $tempGoals = $this->db->get()->result();

        $this->db->where('uniq_code', $codeUniq);
        $this->db->from('tblgoals');
        $goals = $this->db->get()->result();

        if ($tempGoals[0] != '') {
            $data = [
                'goals' => $tempGoals,
                'codeUniq' => $codeUniq
            ];
        } else {
            $data = [
                'goals' => $goals,
                'codeUniq' => $codeUniq
            ];
        }

        $this->load->view('hrm/goals', $data);
        // print_r($data);
    }

    public function summary()
    {
        $this->load->view('hrm/summary');
    }

    public function updateSummary($codeUniq)
    {
        $this->db->where('uniq_code', $codeUniq);
        $this->db->from('tbltemp_goals');
        $goals = $this->db->get()->result();

        $data = [
            'goals' => $goals
        ];

        $this->load->view('hrm/summary', $data);
    }

    public function reminder()
    {
        $this->load->view('hrm/reminder');
    }

    public function midYearEvaluationObjective()
    {
        $this->load->view('hrm/mid_year_evaluation/objective');
    }

    public function midYearEvaluationBehavior()
    {
        $this->load->view('hrm/mid_year_evaluation/behavior');
    }

    public function midYearEvaluationSummary()
    {
        $this->load->view('hrm/mid_year_evaluation/summary');
    }

    public function finalAnnualEvaluationObjective()
    {
        $this->load->view('hrm/final_annual_evaluation/objective');
    }

    public function finalAnnualEvaluationBehavior()
    {
        $this->load->view('hrm/final_annual_evaluation/behavior');
    }

    public function finalAnnualEvaluationOverallEvaluation()
    {
        $this->load->view('hrm/final_annual_evaluation/overall_evaluation');
    }

    public function finalAnnualEvaluationSummary()
    {
        $this->load->view('hrm/final_annual_evaluation/summary');
    }

    public function pmanagement()
    {
        $this->load->view('hrm/performance_management');
    }

    public function behavior()
    {
        $this->load->view('hrm/behavior');
    }

    public function objectives()
    {
        $this->load->view('hrm/objectives');
    }

    public function staff()
    {
        $this->load->view('hrm/staff');
    }
}
