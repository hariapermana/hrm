<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Testing extends AdminController
{
    public function index()
    {
        $this->load->view('manager/index');
    }
}