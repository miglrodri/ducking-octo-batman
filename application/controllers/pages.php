<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index() {
		//$this->load->view('welcome_message');
        $data['success'] = 'blank';
        
        $this->db->select()->from('test');
		$query = $this->db->get();
		$data['database'] = $query->result_array();
        
        $data['server'] = $_SERVER['SERVER_NAME'];
        $data['hello'] =  "Hello, world!";
        
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        
        echo "<pre>";
        print_r(ENVIRONMENT);
        echo '</pre>';
        
        $this->load->helper('httprequest');
        $url = 'http://m.zerozero.pt/zapping.php';
        $results = getGamesZapping($url);
        echo var_dump($results);
        
	}
    
}