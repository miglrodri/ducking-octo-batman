<?php

class User extends CI_Model {

	function getUsers() {
		$this->db->select()->from('users');
		$query = $this->db->get();
		return $query->result_array();
	}

	function insertUser($data) {
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	function truncateUsers() {
		$this->db->truncate('users');
	}

}