<?php

defined('BASEPATH') or exit('No direct script access allowed');

class NewPage extends AdminController
{
    public function index()
    {
        $this->db->select('g.uniq_code, MIN(g.subject) as subject, MIN(g.start_date) as start_date, MIN(g.start_date) as end_date, MIN(g.id) as id, MIN(s.firstname) as firstname, MIN(s.lastname) as lastname');
        $this->db->from('tblgoals as g');
        $this->db->join('tblstaff as s', 's.staffid = g.staff_id');
        $this->db->group_by('g.uniq_code');
        $this->db->order_by('MIN(g.id)', 'DESC');
        $inbox = $this->db->get()->result();

        $data = [
            'inbox' => $inbox
        ];

        // print_r($query);

        $this->load->view('hrm/admin/index', $data);
    }

    public function inbox()
    {
        $this->db->select('g.uniq_code, MIN(g.start_date) as start_date, MIN(g.start_date) as end_date, MIN(g.id) as id, MIN(s.firstname) as firstname, MIN(s.lastname) as lastname');
        $this->db->from('tblgoals as g');
        $this->db->join('tblstaff as s', 's.staffid = g.staff_id');
        $this->db->group_by('g.uniq_code');
        $this->db->order_by('MIN(g.id)', 'DESC');
        $data['inboxs'] = $this->db->get()->result();

        $this->load->view('hrm/admin/inbox', $data);
    }

    public function detailInbox($id, $uniq_code = null)
    {
        $this->db->select('g.uniq_code, MIN(g.start_date) as start_date, MIN(g.end_date) as end_date, MIN(g.id) as id, MIN(s.firstname) as firstname, MIN(s.lastname) as lastname');
        $this->db->from('tblgoals as g');
        $this->db->join('tblstaff as s', 's.staffid = g.staff_id');
        $this->db->group_by('g.uniq_code');
        $this->db->order_by('MIN(g.id)', 'DESC');
        $data['inboxs'] = $this->db->get()->result();

        $this->db->select('g.*');
        $this->db->from('tblgoals as g');
        $this->db->where('g.uniq_code', $uniq_code);
        $this->db->order_by('g.id', 'DESC');
        $data['detailInbox'] = $this->db->get()->result();

        $this->db->select('s.staffid, s.firstname, s.lastname');
        $this->db->from('tblstaff as s');
        $this->db->join('tblgoals as g', 'g.staff_id = s.staffid');
        $this->db->where('g.id', $id);
        $data['staff'] = $this->db->get()->result();

        $this->db->select('*');
        $this->db->from('tblgoals_status');
        $this->db->where('uniq_code', $uniq_code);
        $data['goals'] = $this->db->get()->result();
        
        // print_r($data);
        $this->load->view('hrm/admin/inbox', $data);
    }

    public function performance()
    {
        $this->load->view('hrm/admin/performance');
    }

    public function reminder()
    {
        $this->load->view('hrm/admin/reminder');
    }
}
