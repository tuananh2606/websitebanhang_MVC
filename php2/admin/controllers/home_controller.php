<?php
session_start();
require_once(ROOTDIR.'/models/sanpham_model.php');
require_once(ROOTDIR.'/models/thanhvien_model.php');
require_once(ROOTDIR.'/models/giaodich_model.php');
require_once(ROOTDIR.'/models/danhmucsp_model.php');
class home_controller {
	function __construct(){
		if(!isset($_SESSION['user'])){
			header("Location: /php2/admin/?controller=index&action=login");
		}
	}
	function run() {		
		$actionGET = filter_input(INPUT_GET,'action');
		
		
		if (method_exists($this,$actionGET)) {
			$this->$actionGET();
		}
		else {
			//print "Execute extend action";
			$this->list();
		}
	}
	function list(){
		$sanpham_model = new SANPHAM_MODEL();
		$thanhvien_model = new THANHVIEN_MODEL();
		$giaodich_model = new GIAODICH_MODEL();
		$danhmucsp_model = new DANHMUCSP_MODEL();
		$data[] = $sanpham_model->allSP();
		$data[] = $thanhvien_model->allTV();
		$data[] = $giaodich_model->allGD();
		$data[] = $danhmucsp_model->allDMSP();
		require_once("views/home.php");
	}
}
?>