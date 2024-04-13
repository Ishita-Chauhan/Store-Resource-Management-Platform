<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelusers');
	}
	public function index()
	{
		
		$result = $this->modelusers->createNewList();
		
		$data = array('lid' => 3, 'page' => 'users/listUsers', 'title' => 'Users', 'rows' => $result['row'], 'cols' => $result['col']);
		
		$this->load->view('admin/menu', $data);
		
	}
	public function createUsers()
	{
		$result = $this->modelusers->insertUsers();
		echo ($result) ? json_encode($result) : 0;
	}
	public function editUsers()
	{
		$result = $this->modelusers->updateUsers();
		echo ($result) ? json_encode($result) : 0;
	}
	public function removeUsers()
	{
		$result = $this->modelusers->deleteUsers();
		echo ($result) ? json_encode($result) : 0;
	}
	public function showEdit()
	{
		$id = $_POST['id'];
		$data = $this->db->query('select * from users where id=' . $id)->row();
		echo json_encode($data);
	}
}
