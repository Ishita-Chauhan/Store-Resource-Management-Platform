<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modelpurchasedetails extends CI_Model
{
	public function insertPurchasedetails()
	{
		//code for insert
		$data = array('purchases_id' => $_POST['purchases_id'], 'qty' => $_POST['qty'], 'authorities_id' => $_POST['authorities_id'], 'price' => $_POST['price'], 'status' => $_POST['status'], 'reasonForUnserviceability' => $_POST['reasonForUnserviceability'], 'expectedExp' => $_POST['expectedExp'], 'articles_id' => $_POST['articles_id']);
		$result = $this->db->insert('purchasedetails', $data);
		return ($result) ? $this->createNewList() : false;
	}
	public function updatePurchasedetails()
	{
		//code for update
		$id = $_POST['idPurchasedetails'];
		$data = array('purchases_id' => $_POST['purchases_id'], 'qty' => $_POST['qty'], 'authorities_id' => $_POST['authorities_id'], 'price' => $_POST['price'], 'status' => $_POST['status'], 'reasonForUnserviceability' => $_POST['reasonForUnserviceability'], 'expectedExp' => $_POST['expectedExp'], 'articles_id' => $_POST['articles_id']);
		$result = $this->db->update('purchasedetails', $data, array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function deletePurchasedetails()
	{
		$id = $_POST['id'];
		$result = $this->db->delete('purchasedetails', array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function createNewList()
	{
		return $this->storemgt->getListSerial('select * from purchasedetails', array('id'));
	}
}
