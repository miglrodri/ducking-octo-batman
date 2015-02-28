<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index()
	{
		//$this->load->view('welcome_message');
        $data['success'] = 'blank';
        
        $this->db->select()->from('test');
		$query = $this->db->get();
		$data['database'] = $query->result_array();
        
        $data['server'] = $_SERVER['SERVER_NAME'];
        $data['hello'] =  "Hello, world!";
        
        var_dump($data);
	}
}