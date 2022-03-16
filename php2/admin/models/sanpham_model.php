<?php 
// print ROOTDIR.'/models/model.php';
require_once('model.php');
require_once(ROOTDIR.'/connection.php');

class SANPHAM_MODEL extends MODEL {
	function __construct($table_name='') {
		parent::__construct($table_name);
	}
	function allSP() {
		global $conn;
		$sql = "SELECT MaSanPham FROM sanpham";
		$rs = mysqli_query($conn, $sql);
		$row = mysqli_num_rows($rs);
		return $row;
	}
}
?>