<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index()
	{
		//$this->load->view('welcome_message');
        $data['success'] = 'blank';
        
        $services_json = json_decode(getenv("VCAP_SERVICES"),true);
        $mysql_config = $services_json["mysql-5.1"][0]["credentials"];

        $username = $mysql_config["username"];
        $password = $mysql_config["password"];
        $hostname = $mysql_config["hostname"];
        $port = $mysql_config["port"];
        $db = $mysql_config["name"];

        $test = mysql_connect($hostname,$username,$password);

        $data['test'] = $test;
        
        if(!$test) {
            $data['success'] = "Could not connect: " . mysql_error());
        }
        else {
            $data['success'] = 'Connected successfully';
            mysql_close($test);
        }
        
        $data['hello'] =  "Hello, world!";
        
        var_dump($data);
	}
}