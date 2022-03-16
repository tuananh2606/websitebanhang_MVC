<?php 
require_once(ROOTDIR.'/models/model.php');

class DANHMUCSP_MODEL extends MODEL {
	
	function __construct($table_name='') {
		parent::__construct($table_name);
	}
	
	function allDMSP() {
		global $conn;
		$sql = "SELECT MaLoaiSP FROM loaisanpham";
		$rs = mysqli_query($conn, $sql);
		$row = mysqli_num_rows($rs);
		return $row;
	}
}
?>