<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Articles extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelarticles');
	}
	public function index()
	{
		$result = $this->modelarticles->createNewList();
		$data = array('lid' => 0, 'page' => 'articles/listArticles', 'title' => 'Articles', 'rows' => $result['row'], 'cols' => $result['col']);
		$this->load->view('admin/menu', $data);
	}
	public function createArticles()
	{
		$result = $this->modelarticles->insertArticles();
		echo ($result) ? json_encode($result) : 0;
	}
	public function editArticles()
	{
		$result = $this->modelarticles->updateArticles();
		echo ($result) ? json_encode($result) : 0;
	}
	public function removeArticles()
	{
		$result = $this->modelarticles->deleteArticles();
		echo ($result) ? json_encode($result) : 0;
	}
	public function showEdit()
	{
		$id = $_POST['id'];
		$data = $this->db->query('select * from articles where id=' . $id)->row();
		echo json_encode($data);
	}
}
