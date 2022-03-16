<?php
require_once("./models/users_model.php");
session_start();
class index_controller
{
	public function run() {
		$actionGET = filter_input(INPUT_GET,'action');
		if (method_exists($this,$actionGET)) {
			$this->$actionGET();
		}
		else {
			$this->index();
		}
	}
	function index(){
		require_once ('views/login.php');
	}
	function login()
	{
		//$_SESSION['check'] = false;
		$username = filter_input(INPUT_POST,'username');
		$password = filter_input(INPUT_POST,'password');
		$user = new USERMODEL('thanhvien');
		$row = $user->selectby('username',$username);
		if($row['password']==$password && $row['level']==1){
			echo 'Success';
			$_SESSION['user'] = $row;
		}
	}

	function logout()
	{
		session_unset();
		session_destroy();
		unset($_SESSION['user']);
		header ("Location: /php2/admin");
	}
}
?>