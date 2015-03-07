<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To run this on CLI
 * http://stevethomas.com.au/php/database-seeding-in-codeigniter.html
 * see php version: php -v
 * $ php index.php reset index
 */

class Reset extends CI_Controller {
	function __construct(){
		parent::__construct();

		// can only be called from the command line
		if (!$this->input->is_cli_request()) {
			redirect(base_url());
		}
 
		// can only be run in the development environment
		if (ENVIRONMENT !== 'development') {
			exit('Wowsers! You don\'t want to do that!');
		}
 
		// initiate faker
		$this->faker = Faker\Factory::create();
 
		// load any required models
		$this->load->model('user');
	}
 
	/**
	* seed local database
	*/
	function index() {

		$number_of_users = 25;

		echo 'seeding: STARTING\n';
		echo PHP_EOL;

		// purge existing data
		$this->_truncate_db();
		echo 'seeding: DELETED TABLES\n';
		echo PHP_EOL;

		// seed users
		$this->_seed_users($number_of_users);
 
		echo 'seeding: DONE\n';
		echo PHP_EOL;

		//redirect(base_url());
	}
 
	/**
	* seed users
	*
	* @param int $limit
	*/
	function _seed_users($limit) {
		echo "seeding: $limit USERS";
		// create a bunch of base user accounts
		for ($i = 0; $i < $limit; $i++) {
			echo ".";
			if ($i == 0) {
				$data = array(
					'name' => 'Miguel Jesus',
					'country' => $this->faker->country,
					'registration_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
					'username' => 'miglrodri',
					'email' => $this->faker->email,
					'password' => '1234567',
				);
			}
			else {
				$data = array(
					'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
					'country' => $this->faker->country,
					'registration_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
					'username' => $this->faker->unique()->userName, // get a unique nickname
					'email' => $this->faker->email,
					'password' => '1234567', // run this via your password hashing function
				);	
			}

			$this->user->insertUser($data);
		}

		echo PHP_EOL;
	}
 
	private function _truncate_db()
	{
		$this->user->truncateUsers();
	}

}