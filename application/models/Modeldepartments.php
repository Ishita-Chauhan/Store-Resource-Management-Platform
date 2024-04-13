<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modeldepartments extends CI_Model
{
	public function insertDepartments()
	{
		//code for insert
		$data = array('name' => $_POST['name'], 'contact' => $_POST['contact'], 'status' => $_POST['status']);
		$result = $this->db->insert('departments', $data);
		return ($result) ? $this->createNewList() : false;
	}
	public function updateDepartments()
	{
		//code for update
		$id = $_POST['idDepartments'];
		$data = array('name' => $_POST['name'], 'contact' => $_POST['contact'], 'status' => $_POST['status']);
		$result = $this->db->update('departments', $data, array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function deleteDepartments()
	{
		$id = $_POST['id'];
		$result = $this->db->delete('departments', array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function createNewList()
	{
		return $this->storemgt->getListSerial('select * from departments', array('id','name','contact'));
	}
}
