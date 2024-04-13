<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Purchaserequests extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelpurchaserequests');
	}
	public function index()
	{
		$result = $this->modelpurchaserequests->createNewList();
		$data = array('lid' => 0, 'page' => 'purchaserequests/listPurchaserequests', 'title' => 'Purchaserequests', 'rows' => $result['row'], 'cols' => $result['col']);
		$this->load->view('main', $data);
	}
	public function createPurchaserequests()
	{
		$result = $this->modelpurchaserequests->insertPurchaserequests();
		echo ($result) ? json_encode($result) : 0;
	}
	public function editPurchaserequests()
	{
		$result = $this->modelpurchaserequests->updatePurchaserequests();
		echo ($result) ? json_encode($result) : 0;
	}
	public function removePurchaserequests()
	{
		$result = $this->modelpurchaserequests->deletePurchaserequests();
		echo ($result) ? json_encode($result) : 0;
	}
	public function showEdit()
	{
		$id = $_POST['id'];
		$data = $this->db->query('select * from purchaserequests where id=' . $id)->row();
		echo json_encode($data);
	}
}
