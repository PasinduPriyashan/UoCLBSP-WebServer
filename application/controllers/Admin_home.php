<?php

class Admin_home extends CI_Controller
{
    public function index()
    {
        $data["call"] = True;
        $this->load->view('include/header',$data);
        $this->load->view('include/side_navbar');
        //$this->load->view('admin_home');

    }


    public function add_polygon(){
        $this->load->view('add_geofence');
    }

    public function add_road(){
        $this->load->view('add_road');
    }

    public function buildings()
    {
        $this->load->view('buildings/add_building');
    }

    public function people()
    {
        $this->load->view('people/add_people');
    }
    
    public function search()
    {
        $this->load->view('admin_map');
    }

    public function test(){
        $this->load->view('test');
    }

}
