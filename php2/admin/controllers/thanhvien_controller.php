<?php
session_start();
require_once(ROOTDIR.'/models/thanhvien_model.php');
class thanhvien_controller {
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
			$username = filter_input(INPUT_POST,'taikhoan_tv');
			$password = filter_input(INPUT_POST,'matkhau_tv');
			$level = filter_input(INPUT_POST,'quyen_tv');
			$thanhvien = new ENTITY();
			$thanhvien->username = $username;
			$thanhvien->password = $password;
			$thanhvien->level = $level;
			$thanhvien_model = new THANHVIEN_MODEL('thanhvien');
			$insert_thanhvien = $thanhvien_model->insert($thanhvien);
			if ($insert_thanhvien) {
				print "Insert Sucess";
			}
			else 
				print "Insert failed";
	}
	function update() {
		$actionPOST = filter_input(INPUT_POST,"action");
			$thanhvien_id = filter_input(INPUT_POST,"ID_up");
			$password = filter_input(INPUT_POST,"Userpasstv_up");
			$level = filter_input(INPUT_POST,"Leveltv_up");
            
			$control = new entity();
			$control->thanhvien_id = $thanhvien_id;

			$change = new entity();
			$change->password = $password;
			$change->level = $level;

			$thanhvien_model = new THANHVIEN_MODEL('thanhvien');
            $update_thanhvien = $thanhvien_model->update($control,$change);
			if (!$update_thanhvien)
				print "Update failed";
	}
	function deletebyid() {
		$actionPOST = filter_input(INPUT_POST,"action");
			$thanhvien_id = filter_input(INPUT_POST,"delete_id");
			$thanhvien = new ENTITY();
			$thanhvien->thanhvien_id = $thanhvien_id;
			$thanhvien_model = new THANHVIEN_MODEL('thanhvien');
			$delete_ID = $thanhvien_model->deletebyid($thanhvien,$thanhvien_id);
			if (!$delete_ID)
				print "Delete failed";
	}
	function list() {
		$thanhvien_model = new THANHVIEN_MODEL('thanhvien');
		
		$list_thanhvien = $thanhvien_model->select();
		
		require_once("views/list_thanhvien.php");
	}
}
?>