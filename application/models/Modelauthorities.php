<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modelauthorities extends CI_Model
{
	public function insertAuthorities()
	{
		//code for insert
		$data = array('name' => $_POST['name'], 'contactPersonName' => $_POST['contactPersonName'], 'contactNo' => $_POST['contactNo']);
		$result = $this->db->insert('authorities', $data);
		return ($result) ? $this->createNewList() : false;
	}
	public function updateAuthorities()
	{
		//code for update
		$id = $_POST['idAuthorities'];
		$data = array('name' => $_POST['name'], 'contactPersonName' => $_POST['contactPersonName'], 'contactNo' => $_POST['contactNo']);
		$result = $this->db->update('authorities', $data, array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function deleteAuthorities()
	{
		$id = $_POST['id'];
		$result = $this->db->delete('authorities', array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function createNewList()
	{
		return $this->storemgt->getListSerial('select * from authorities', array('id','name','contactPersonName','contactNo',));
	}
}
