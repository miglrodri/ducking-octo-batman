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

        public function users() {
                $this->load->model('user');
                $users = $this->user->getUsers();
                $this->load->library('table');
                $this->table->set_heading('Id', 'Name', 'Country', 'Registration', 'Username', 'Email', 'Password');
                $data['result'] = $this->table->generate($users);
                $this->load->view('users_list', $data);
        }
    
}