<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Authorities extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelauthorities');
	}
	public function index()
	{
		$result = $this->modelauthorities->createNewList();
		$data = array('lid' => 4, 'page' => 'authorities/listAuthorities', 'title' => 'Authorities', 'rows' => $result['row'], 'cols' => $result['col']);
		$this->load->view('admin/menu', $data);
	}
	public function createAuthorities()
	{
		$result = $this->modelauthorities->insertAuthorities();
		echo ($result) ? json_encode($result) : 0;
	}
	public function editAuthorities()
	{
		$result = $this->modelauthorities->updateAuthorities();
		echo ($result) ? json_encode($result) : 0;
	}
	public function removeAuthorities()
	{
		$result = $this->modelauthorities->deleteAuthorities();
		echo ($result) ? json_encode($result) : 0;
	}
	public function showEdit()
	{
		$id = $_POST['id'];
		$data = $this->db->query('select * from authorities where id=' . $id)->row();
		echo json_encode($data);
	}
}
