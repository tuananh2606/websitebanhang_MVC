<?php 
session_start();
require_once(ROOTDIR.'/models/sanpham_model.php');
class sanpham_controller {
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
		
			$MaLoaiSP = filter_input(INPUT_POST,'product_ct_id');
			$TenSanPham = filter_input(INPUT_POST,'productName1');
			$HinhAnh = filter_input(INPUT_POST,'productHinhAnh');
			$MoTa = filter_input(INPUT_POST,'productMoTa');
			$SoLuongSP = filter_input(INPUT_POST,'productSoluong');
			$GiaSanPham	= filter_input(INPUT_POST,'productGia1');
			$product = new ENTITY();
			$product->MaLoaiSP = $MaLoaiSP;
			$product->TenSanPham = $TenSanPham;
			$product->HinhAnh = $HinhAnh;
			$product->MoTa = $MoTa;
			$product->SoLuongSP = $SoLuongSP;
			$product->GiaSanPham = $GiaSanPham;
			
			$sanpham_model = new SANPHAM_MODEL('sanpham');
			$insert_product = $sanpham_model->insert($product);
			if (!$insert_product) {
				print "Insert Failed";
			}
			else{
				print "Insert Successful!";
			}
		}
	function update() {
			$MaSanPham = filter_input(INPUT_POST,"ID_up");
			$TenSanPham = filter_input(INPUT_POST,"TenSP_up");
			$HinhAnh = filter_input(INPUT_POST,"HinhAnhSP_up");
			$SoLuongSP = filter_input(INPUT_POST,"SL_up");
			$GiaSanPham = filter_input(INPUT_POST,"Gia_up");
			$MoTa = filter_input(INPUT_POST,"MoTa_up");
            
			$control = new entity();
			$control->MaSanPham = $MaSanPham;

			$change = new entity();
			$change->TenSanPham = $TenSanPham;
			$change->HinhAnh = $HinhAnh;
			$change->SoLuongSP = $SoLuongSP;
			$change->GiaSanPham = $GiaSanPham;
			$change->MoTa = $MoTa;

			$sanpham_model = new SANPHAM_MODEL('sanpham');
            $update_product = $sanpham_model->update($control,$change);
			if (!$update_product) {
				print "Update Failed";
			}
			else{
				print "Update Successful!";
			}
	}
	function deletebyid() {
		$actionPOST = filter_input(INPUT_POST,"action");
			$MaSanPham = filter_input(INPUT_POST,"delete_id");
			$productid = new ENTITY();
			$productid->MaSanPham = $MaSanPham;
			$sanpham_model = new SANPHAM_MODEL('sanpham');
			$delete_ID = $sanpham_model->deletebyid($productid,$MaSanPham);
			if (!$delete_ID) {
				print "Delete Failed";
			}
			else{
				print "Delete Successful!";
			}
	}
	function list() {
		$sanpham_model = new SANPHAM_MODEL('sanpham');
		
		$list_sanpham = $sanpham_model->select();
		
		require_once("views/list_sanpham.php");
	}
}
?>