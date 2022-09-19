<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Temp_goals_model extends App_Model
{
    public function create($goals)
    {
        $this->db->trans_start();
        //GET ID PACKAGE
        // $package_id = $this->db->insert_id();
        $result = array();
        foreach ($goals as $key => $val) {
            $result[] = array(
                'uniq_code' => $goals['sasaran'][$key],
                'subject' => $goals['sasaran'][$key],
                'strategy' => $goals['kpi'][$key],
                'description' => $goals['kpi'][$key],  // Ambil dan set data nama sesuai key array dari $key
                'weight' => $goals['bobot'][$key],  // Ambil dan set data telepon sesuai key array dari $key
                'target' => $goals['target'][$key],  // Ambil dan set data alamat sesuai key array dari $key
                'score' => 0,  // Ambil dan set data alamat sesuai key array dari $key
                'realization' => 0,  // Ambil dan set data alamat sesuai key array dari $key
                'start_date' => $goals['endDate'][$key],  // Ambil dan set data alamat sesuai key array dari $key
                'end_date' => $goals['endDate'][$key],  // Ambil dan set data alamat sesuai key array dari $key
                'goal_type' => 0,  // Ambil dan set data alamat sesuai index array dari $index
                'contract_type' => 0,  // Ambil dan set data alamat sesuai index array dari $index
                'achievement' => 0,  // Ambil dan set data alamat sesuai index array dari $index
                'notify_when_fail' => 1,  // Ambil dan set data alamat sesuai index array dari $index
                'notify_when_achieve' => 1,  // Ambil dan set data alamat sesuai index array dari $index
                'notified' => 0,  // Ambil dan set data alamat sesuai index array dari $index
                'staff_id' => 2,  // Ambil dan set data alamat sesuai index array dari $index
                'status' => 'app',
            );
        }
        //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert('temp_goals', $result);
        $this->db->trans_complete();
    }
}
