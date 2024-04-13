<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modelarticles extends CI_Model
{
	public function insertArticles()
	{
		//code for insert
		$data = array('name' => $_POST['name'], 'nature' => $_POST['nature'], 'price' => $_POST['price'], 'expiry' => $_POST['expiry'], 'description' => $_POST['description'], 'status' => $_POST['status']);
		$result = $this->db->insert('articles', $data);
		return ($result) ? $this->createNewList() : false;
	}
	public function updateArticles()
	{
		//code for update
		$id = $_POST['idArticles'];
		$data = array('name' => $_POST['name'], 'nature' => $_POST['nature'], 'price' => $_POST['price'], 'expiry' => $_POST['expiry'], 'description' => $_POST['description'], 'status' => $_POST['status']);
		$result = $this->db->update('articles', $data, array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function deleteArticles()
	{
		$id = $_POST['id'];
		$result = $this->db->delete('articles', array('id' => $id));
		return ($result) ? $this->createNewList() : false;
	}
	public function createNewList()
	{
		return $this->storemgt->getListSerial('select * from articles', array('id','name','description','price','expiry'));
	}
}
