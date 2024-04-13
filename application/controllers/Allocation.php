<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Allocation extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelallocation');
	}
	public function index()
	{
		$result = $this->modelallocation->createNewList();
		$data = array('lid' => 5, 'page' => 'allocation/listAllocation', 'title' => 'Allocation', 'rows' => $result['row'], 'cols' => $result['col']);
		$this->load->view('admin/menu', $data);
	}
	public function createAllocation()
	{
		$result = $this->modelallocation->insertAllocation();
		echo ($result) ? json_encode($result) : 0;
	}
	public function editAllocation()
	{
		$result = $this->modelallocation->updateAllocation();
		echo ($result) ? json_encode($result) : 0;
	}
	public function removeAllocation()
	{
		$result = $this->modelallocation->deleteAllocation();
		echo ($result) ? json_encode($result) : 0;
	}
	public function showEdit()
	{
		$id = $_POST['id'];
		$data = $this->db->query('select * from allocation where id=' . $id)->row();
		echo json_encode($data);
	}
}
