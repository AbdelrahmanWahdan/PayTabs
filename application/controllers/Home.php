<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	var $data;
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('Home_model');
    }
	
	public function index()
	{
		$this->data['main_categories'] = $this->Home_model->get_categories_by_parent_id(0);
		$this->load->view('Home', $this->data);
	}
	
	public function get_or_create_categories_by_parent_id($parent_id)
	{
		echo json_encode($this->Home_model->get_or_create_categories_by_parent_id($parent_id));
	}
}
