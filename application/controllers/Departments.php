<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Departments extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modeldepartments');
	}
	public function index()
	{
		$result = $this->modeldepartments->createNewList();
		$data = array('lid' => 2, 'page' => 'departments/listDepartments', 'title' => 'Departments', 'rows' => $result['row'], 'cols' => $result['col']);
		$this->load->view('admin/menu', $data);
	}
	public function createDepartments()
	{
		$result = $this->modeldepartments->insertDepartments();
		echo ($result) ? json_encode($result) : 0;
	}
	public function editDepartments()
	{
		$result = $this->modeldepartments->updateDepartments();
		echo ($result) ? json_encode($result) : 0;
	}
	public function removeDepartments()
	{
		$result = $this->modeldepartments->deleteDepartments();
		echo ($result) ? json_encode($result) : 0;
	}
	public function showEdit()
	{
		$id = $_POST['id'];
		$data = $this->db->query('select * from departments where id=' . $id)->row();
		echo json_encode($data);
	}
}
