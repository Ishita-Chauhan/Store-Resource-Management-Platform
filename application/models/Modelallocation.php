<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modelallocation extends CI_Model
{
	public function insertAllocation()
	{
		//code for insert
		$data = array('name' => $_POST['name'], 'purchaseDetails_id' => $_POST['purchaseDetails_id'], 'departments_id' => $_POST['departments_id'], 'detailsOfDeadStockReg' => $_POST['detailsOfDeadStockReg'], 'unServDate' => $_POST['unServDate'], 'actualPeriodOfUnServ' => $_POST['actualPeriodOfUnServ'], 'ts' => $_POST['ts'], 'responsibilityForDamage' => $_POST['responsibilityForDamage'], 'repairable' => $_POST['repairable'], 'costOfRepair' => $_POST['costOfRepair'], 'status' => $_POST['status'], 'descriptionOfDefects' => $_POST['descriptionOfDefects'], 'remarks' => $_POST['remarks']);
		$result = $this->db->insert('allocation', $data);
		return ($result) ? $this->createNewList() : false;
	}
	public function updateAllocation()
	{
		//code for update
		$id = $_POST['idAllocation'];
		$data = array('name' => $_POST['name'], 'purchaseDetails_id' => $_POST['purchaseDetails_id'], 'departments_id' => $_POST['departments_id'], 'detailsOfDeadStockReg' => $_POST['detailsOfDeadStockReg'], 'unServDate' => $_POST['unServDate'], 'actualPeriodOfUnServ' => $_POST['actualPeriodOfUnServ'], 'ts' => $_POST['ts'], 'responsibilityForDamage' => $_POST['responsibilityForDamage'], 'repairable' => $_POST['repairable'], 'costOfRepair' => $_POST['costOfRepair'], 'status' => $_POST['status'], 'descriptionOfDefects' => $_POST['descriptionOfDefects'], 'remarks' => $_POST['remarks']);
		$result = $this->db->update('allocation', $data, array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function deleteAllocation()
	{
		$id = $_POST['id'];
		$result = $this->db->delete('allocation', array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function createNewList()
	{
		return $this->storemgt->getListSerial('select * from allocation', array('id'));
	}
}
