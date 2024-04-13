<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modelpurchaserequests extends CI_Model
{
	public function insertPurchaserequests()
	{
		//code for insert
		$data = array('dateOfReq' => $_POST['dateOfReq'], 'users_id' => $_POST['users_id'], 'ts' => $_POST['ts'], 'status' => $_POST['status']);
		$result = $this->db->insert('purchaserequests', $data);
		return ($result) ? $this->createNewList() : false;
	}
	public function updatePurchaserequests()
	{
		//code for update
		$id = $_POST['idPurchaserequests'];
		$data = array('dateOfReq' => $_POST['dateOfReq'], 'users_id' => $_POST['users_id'], 'ts' => $_POST['ts'], 'status' => $_POST['status']);
		$result = $this->db->update('purchaserequests', $data, array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function deletePurchaserequests()
	{
		$id = $_POST['id'];
		$result = $this->db->delete('purchaserequests', array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function createNewList()
	{
		return $this->storemgt->getListSerial('select * from purchaserequests', array('id'));
	}
}
