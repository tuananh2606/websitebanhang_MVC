<?php 
require_once('model.php');
require_once(ROOTDIR.'/connection.php');

class GIAODICH_MODEL extends MODEL {
	function __construct($table_name='') {
		parent::__construct($table_name);
	}
	function allGD() {
		global $conn;
		$sql = "SELECT MaDonHang FROM donhang";
		$rs = mysqli_query($conn, $sql);
		$row = mysqli_num_rows($rs);
		return $row;
	}
}
?>