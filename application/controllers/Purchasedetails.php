<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Purchasedetails extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelpurchasedetails');
	}
	public function index()
	{
		$result = $this->modelpurchasedetails->createNewList();
		$data = array('lid' => 0, 'page' => 'purchasedetails/listPurchasedetails', 'title' => 'Purchasedetails', 'rows' => $result['row'], 'cols' => $result['col']);
		$this->load->view('main', $data);
	}
	public function createPurchasedetails()
	{
		$result = $this->modelpurchasedetails->insertPurchasedetails();
		echo ($result) ? json_encode($result) : 0;
	}
	public function editPurchasedetails()
	{
		$result = $this->modelpurchasedetails->updatePurchasedetails();
		echo ($result) ? json_encode($result) : 0;
	}
	public function removePurchasedetails()
	{
		$result = $this->modelpurchasedetails->deletePurchasedetails();
		echo ($result) ? json_encode($result) : 0;
	}
	public function showEdit()
	{
		$id = $_POST['id'];
		$data = $this->db->query('select * from purchasedetails where id=' . $id)->row();
		echo json_encode($data);
	}
}
