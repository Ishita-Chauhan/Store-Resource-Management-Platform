<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Purchases extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelpurchases');
	}
	public function index()
	{
		$result = $this->modelpurchases->createNewList();
		$data = array('lid' => 6, 'page' => 'purchases/listPurchases', 'title' => 'Purchases', 'rows' => $result['row'], 'cols' => $result['col']);
		$this->load->view('admin/menu', $data);
	}
	public function createPurchases()
	{
		$result = $this->modelpurchases->insertPurchases();
		echo ($result) ? json_encode($result) : 0;
	}
	public function editPurchases()
	{
		$result = $this->modelpurchases->updatePurchases();
		echo ($result) ? json_encode($result) : 0;
	}
	public function removePurchases()
	{
		$result = $this->modelpurchases->deletePurchases();
		echo ($result) ? json_encode($result) : 0;
	}
	public function showEdit()
	{
		$id = $_POST['id'];
		$data = $this->db->query('select * from purchases where id=' . $id)->row();
		echo json_encode($data);
	}
}
