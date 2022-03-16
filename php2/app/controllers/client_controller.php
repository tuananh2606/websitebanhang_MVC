<?php
session_start();
require_once("./model/product.php");
require_once("./model/user.php");
require_once("./model/entity.php");
	class client_controller
	{
		function run() {	
			$actionGET = filter_input(INPUT_GET,'action');
			
			if (method_exists($this,$actionGET)) 
			{
				$this->$actionGET();
			}
			else
			{
				//$this->index();
			}
		}

		function index(){
			$data = new Product('loaisanpham');
			$category_re = $data->select();
			$numberRecordPerPage = 9;
			$numberPage	= $data->productperPage($numberRecordPerPage);
			$pro_records = $data->getProductforPage(1,$numberRecordPerPage);
			//var_dump($category_re);
			require_once ('./views/eshop/index.php');
		}
		function viewaccount(){
			if(isset($_SESSION['client'])){
				$id = $_SESSION['client']['thanhvien_id'];
				$order_model = new  Product();
				$list_order = $order_model->getOrderById($id);
				require_once('views/eshop/profile.php');}
			else {
				header('Location:/php2/app/?controller=index&action=login');
			}
		}
		function updateacc(){
			if(isset($_SESSION['client'])){
				$thanhvien_id = $_SESSION['client']['thanhvien_id'];
				$email = filter_input(INPUT_POST,"Email_up");
				$phone = filter_input(INPUT_POST,"Phone_up");
				$control = new entity();
				$control->thanhvien_id = $thanhvien_id;

				$change = new entity();
				$change->email = $email;
				$change->phone = $phone;
				$user_model = new User('thanhvien');
				$update_user = $user_model->update($control,$change);
				$user1 = new User();
				$client_up = $user1->getUserByID($thanhvien_id);
				$_SESSION['client_up']= $client_up;
				if (!$update_user) {
					print "Update Failed";
				}
				else{
					print "Update Successful!";
				}			
			}
			$_SESSION['client'] = $_SESSION['client_up'];
		}
		function viewcart(){
			//unset($_SESSION['cart']);
			if(isset($_SESSION['cart'])){
			$product = $_SESSION['cart'];}
			require_once('views/eshop/cart.php');
		}
		function addtocart(){
			$product_model = new  Product();
			$product_id = $_POST['id'] ?? NULL;
			$product = $product_model->getProductById($product_id);
			if(empty($_SESSION['cart']) || !array_key_exists($product_id, $_SESSION['cart'])){
				$product['qty'] = 1;
				$_SESSION['cart'][$product_id] = $product;
			}
			else {
				$product['qty'] = $_SESSION['cart'][$product_id]['qty']+1;
				$_SESSION['cart'][$product_id] = $product;
			}
		}
		function update(){
			$cart = $_SESSION['cart'];
			if(isset($_POST['id']) && isset($_POST['qty'])){
				$id = $_POST['id'];
				$qty = $_POST['qty'];
				if($qty < 0 || !is_numeric($qty)){
					foreach($cart as $sp){
						$qty = $cart['qty'][$id];
					}
				}
				elseif($qty == 0){
					unset($_SESSION['cart'][$id]);
				}
				else{
				$qty = $_POST['qty'];
				}
				$cart = $_SESSION['cart'];
				if(array_key_exists($id, $cart)){
					$cart[$id] = array(
						'TenSanPham'=>$cart[$id]['TenSanPham'],
						'HinhAnh'=>$cart[$id]['HinhAnh'],
						'GiaSanPham'=>$cart[$id]['GiaSanPham'],
						'qty'=>$qty
					);
					$_SESSION['cart'] = $cart;
				}
			}
		}
		function delete(){
			$product_id = $_GET['id'] ?? NULL;
			unset($_SESSION['cart'][$product_id]);
			header('Location:index.php?controller=client&action=viewcart');	
		}
		function order(){
			if(isset($_SESSION['cart'])){
			$product = $_SESSION['cart'];}
			require_once('views/eshop/checkout.php');
		}
		function saveorder(){
			$cart = $_SESSION['cart'];
			$id_client = $_SESSION['client']['thanhvien_id'];
			$TenKhachHang = $_POST['Name_add'];
			$Email = $_POST['Email_add'];
			$Phone = $_POST['Phone_add'];
			$DiaChiGiaoHang = $_POST['Address_add'];
			$NgayLap = new DateTime(null, new DateTimeZone('ASIA/Ho_Chi_Minh'));
			$NgayLap1 = $NgayLap->format('Y-m-d H:i:s');
			$data = new ENTITY();
			$data->thanhvien_id = $id_client;
			$data->TenKhachHang = $TenKhachHang;
			$data->Email = $Email;
			$data->Phone = $Phone;
			$data->DiaChiGiaoHang = $DiaChiGiaoHang;
			$data->NgayLap = $NgayLap1;
			$TongTien = 0;
			foreach($cart as $key => $value){
				$TongTien +=(int)$value['GiaSanPham'] * (int)$value['qty'];
			}
			$data->TongTien = $TongTien;
			$product_model = new  Product;
			$save_order = $product_model->saveorder('donhang',$data);
			
			foreach($cart as $key => $value){
				$MaDonHang = $save_order;
				$MaSanPham = $value['MaSanPham'];
				$SoLuong = $value['qty'];
				$ThanhTien = $value['qty']*$value['GiaSanPham'];
				$if_order = new ENTITY();
				$if_order->MaSanPham = $MaSanPham;
				$if_order->MaDonHang = $MaDonHang;
				$if_order->SoLuong = $SoLuong;
				$if_order->ThanhTien = $ThanhTien;
				$save_iforder = $product_model->saveorder('chitietdonhang',$if_order);
			}
			$temp = array($TenKhachHang,$Email,$MaDonHang,$TongTien);
			$_SESSION['temp'] = $temp;
			$_SESSION['cart']= NULL;
		}
		function ordercomplete(){
			$_SESSION['temp'];
			$product_model = new  Product;
			require_once('views/eshop/pages/sendemail.php');
			require_once('views/eshop/checkoutComplete.php');

			unset($_SESSION['temp']);
		}

	}
?>