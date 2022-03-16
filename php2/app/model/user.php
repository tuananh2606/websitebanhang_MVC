<?php
require_once("model.php");
class User extends Model
{
    function __construct($table_name='') {
		parent::__construct($table_name);
	}
	function checkUser($key)
	{
		global $conn;
		$myStrSQL = "SELECT * FROM thanhvien WHERE username = '{$key}'";
		$check = mysqli_query($conn,$myStrSQL) or die('Error query: '.mysqli_error($this->conn));
		if (mysqli_num_rows($check) > 0){
            return false;
        }
		return true;
	}
	function getUser($username){
		global $conn;
		$sql = "SELECT * FROM thanhvien WHERE username  = '".$username."'";
		$rs = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($rs);
		return $row;
	}
	function getUserByID($thanhvien_id){
		global $conn;
		$sql = "SELECT * FROM thanhvien WHERE thanhvien_id  = '".$thanhvien_id."'";
		$rs = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($rs);
		return $row;
	}
}
?>