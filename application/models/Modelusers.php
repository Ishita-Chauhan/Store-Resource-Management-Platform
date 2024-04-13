<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modelusers extends CI_Model
{
	public function insertUsers()
	{
		//code for insert
		
		$data = array('name' => $_POST['name'], 'departments_id' => $_POST['departments_id'], 'email' => $_POST['email'], 'contact' => $_POST['contact'], 'status' => $_POST['status']);
		$result = $this->db->insert('users', $data);
		return ($result) ? $this->createNewList() : false;
	}
	public function updateUsers()
	{
		//code for update
		$id = $_POST['idUsers'];
		$data = array('name' => $_POST['name'], 'departments_id' => $_POST['departments_id'], 'email' => $_POST['email'], 'contact' => $_POST['contact'], 'status' => $_POST['status']);
		$result = $this->db->update('users', $data, array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function deleteUsers()
	{
		$id = $_POST['id'];
		$result = $this->db->delete('users', array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function createNewList()
	{
		
		return $this->storemgt->getListSerial('select * from users', array('id','name','departments_id','email','contact'));
	}
}
