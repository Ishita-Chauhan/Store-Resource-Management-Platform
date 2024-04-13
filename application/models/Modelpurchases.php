<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modelpurchases extends CI_Model
{
	public function insertPurchases()
	{
		//code for insert
		$data = array('dateOfPurchase' => $_POST['dateOfPurchase'], 'purchaseRequests_id' => $_POST['purchaseRequests_id']);
		$result = $this->db->insert('purchases', $data);
		return ($result) ? $this->createNewList() : false;
	}
	public function updatePurchases()
	{
		//code for update
		$id = $_POST['idPurchases'];
		$data = array('dateOfPurchase' => $_POST['dateOfPurchase'], 'purchaseRequests_id' => $_POST['purchaseRequests_id']);
		$result = $this->db->update('purchases', $data, array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function deletePurchases()
	{
		$id = $_POST['id'];
		$result = $this->db->delete('purchases', array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function createNewList()
	{
		return $this->storemgt->getListSerial('select * from purchases', array('id'));
	}
}
