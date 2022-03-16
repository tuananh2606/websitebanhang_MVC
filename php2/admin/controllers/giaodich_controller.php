<?php 
session_start();
require_once(ROOTDIR.'/models/giaodich_model.php');
class giaodich_controller {
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
	function update() {
			$MaDonHang = filter_input(INPUT_POST,"ID_up");
			$TenKhachHang = filter_input(INPUT_POST,"Name_up");
			$Email = filter_input(INPUT_POST,"Email_up");
			$Phone = filter_input(INPUT_POST,"Phone_up");
			$DiaChiGiaoHang = filter_input(INPUT_POST,"Address_up");
			$TinhTrang = filter_input(INPUT_POST,"Status_up");
            
			$control = new entity();
			$control->MaDonHang = $MaDonHang;

			$change = new entity();
			$change->TenKhachHang = $TenKhachHang;
			$change->Email = $Email;
			$change->Phone = $Phone;
			$change->DiaChiGiaoHang = $DiaChiGiaoHang;
			$change->TinhTrang = $TinhTrang;

			$giaodich_model = new GIAODICH_MODEL('donhang');
            $update_product = $giaodich_model->update($control,$change);
			if (!$update_product) {
				print "Update Failed";
			}
			else{
				print "Update Successful!";
			}
	}
	function deletebyid() {
		$MaDonHang = filter_input(INPUT_POST,"delete_id");
		$orderid = new ENTITY();
		$orderid->MaDonHang = $MaDonHang;
		$giaodich_model = new GIAODICH_MODEL('donhang');
		$delete_ID = $giaodich_model->deletebyid($orderid,$MaDonHang);
		if (!$delete_ID) {
			print "Delete Failed";
		}
		else{
			print "Delete Successful!";
		}
	}
	function list() {
		$giaodich_model = new GIAODICH_MODEL('donhang');
		
		$list_giaodich = $giaodich_model->select();
		
		require_once("views/list_giaodich.php");
	}
}
?>