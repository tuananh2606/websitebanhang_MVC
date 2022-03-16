<?php
require_once("connection.php");
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

	


}
?>