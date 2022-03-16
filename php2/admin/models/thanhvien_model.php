<?php 
require_once(ROOTDIR.'/models/model.php');

class THANHVIEN_MODEL extends MODEL {
	
	function __construct($table_name='') {
		parent::__construct($table_name);
	}
	
	function allTV() {
		global $conn;
		$sql = "SELECT thanhvien_id FROM thanhvien";
		$rs = mysqli_query($conn, $sql);
		$row = mysqli_num_rows($rs);
		return $row;
	}
}
?>