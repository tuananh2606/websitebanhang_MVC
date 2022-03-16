<?php 
require_once(ROOTDIR.'/models/danhmucsp_model.php');
?>
<?php
session_start();
class danhmucsp_controller 
{
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
			$this->list();
		}
	}
	function add() {
		$actionPOST = filter_input(INPUT_POST,'action');
			$TenLoaiSP = filter_input(INPUT_POST,'danhmucsp_add');
			$category = new ENTITY();
			$category->TenLoaiSP = $TenLoaiSP;			
			$danhmucsp_model = new DANHMUCSP_MODEL('loaisanpham');
			$insert_category = $danhmucsp_model->insert($category);
			if (!$insert_category) {
				print "Insert Failed";
			}
			else{
				print "Insert Successful!";
			}
	}
	function update() {
		$actionPOST = filter_input(INPUT_POST,"action");
			$MaLoaiSP = filter_input(INPUT_POST,"ID_up");
			$TenLoaiSP = filter_input(INPUT_POST,"CategoryName_up");
            
			$control = new entity();
			$control->MaLoaiSP = $MaLoaiSP;

			$change = new entity();
			$change->TenLoaiSP = $TenLoaiSP;

			$danhmucsp_model = new DANHMUCSP_MODEL('loaisanpham');
            $update_category = $danhmucsp_model->update($control,$change);
			if (!$update_category) {
				print "Update Failed";
			}
			else{
				print "Update Successful!";
			}
	}
	function deletebyid() {
		$actionPOST = filter_input(INPUT_POST,"action");
			$MaLoaiSP = filter_input(INPUT_POST,"delete_id");
			$categoryid = new ENTITY();
			$categoryid->MaLoaiSP = $MaLoaiSP;
			$danhmucsp_model = new DANHMUCSP_MODEL('loaisanpham');
			$delete_ID = $danhmucsp_model->deletebyid($categoryid,$MaLoaiSP);
			if (!$delete_ID) {
				print "Delete Failed";
			}
			else{
				print "Delete Successful!";
			}
	}
	function list() {
		$danhmucsp_model = new DANHMUCSP_MODEL('loaisanpham');
		
		$list_danhmucsanpham = $danhmucsp_model->select();
		
		require_once("views/list_danhmucsanpham.php");
	}
}
?>