<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view("auth/auth");
    }
    public function validateUser($uname, $pass)
    {
        $result = $this->db->query("select * from auth where userid='$uname' and passkey='$pass'");
        if ($result->num_rows() == 1)
            return $result->row();
        else
            return false;
    }
    public function doAuth()
    {
        $uname = $_POST["username"];
        $pass = $_POST["password"];
        $result = $this->validateUser($uname, $pass);
        if ($result) {
            $_SESSION["LOGGEDIN"] = TRUE;
            echo json_encode(array("code" => 200, "message" => "LoggedIn", "target" => base_url("articles")));
        } else {
            echo json_encode(array("code" => 404, "message" => "User Not Found"));
        }
    }
    public function logout()
    {
        $_SESSION["LOGGEDIN"] = FALSE;
        $this->load->view("auth/auth");

    }
}
