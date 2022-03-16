<?php
session_start();
require_once("./model/user.php");
require_once("./model/product.php");
require_once("./model/entity.php");
	class index_controller
	{
		function run() {	
			$actionGET = filter_input(INPUT_GET,'action');
			if(!($this->redirectPage()))
			{
				if (method_exists($this,$actionGET)) 
				{
					$this->$actionGET();
				}
				else
				{
					$this->index();
				}
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

		function login()
		{
			$_SESSION['check'] = false;
			$actionPOST = filter_input(INPUT_POST,'action');
			if (!empty($actionPOST) || $actionPOST=='login') 
			{
				$username = filter_input(INPUT_POST,'username');
				$password = filter_input(INPUT_POST,'password');

				if(empty($username)|| empty($password))
				{
					echo '<script>alert("Điền đủ thông tin tài khoản và mật khẩu!")</script>';
					require_once ('./views/eshop/login.php');
				}
				else
				{
					$user = new User('thanhvien');
					$user1 = new User();
					$user_record = $user->selectbyid('username',$username);
					//print_r($user_record);
					if(!$user_record){
						echo '<script>alert("Tên tài khoản không tồn tại!")</script>';
						require_once ('./views/eshop/login.php');
					}

					else{
						$client = $user1->getUser($username);
						$check = $user_record->getAll();
						if($check['password'] == $password & $check['level']==0){
							$_SESSION['client'] = $client;
							$_SESSION['check'] = true;
							header("Location: /php2/app/index.php");
						}
						else if($check['password'] == $password & $check['level']==1){
							header("Location: /php2/admin");
						}
						else{
							echo '<script>alert("Sai mật khẩu!")</script>';
							require_once ('./views/eshop/login.php');
						}
					}
				}
			}
			else 
			{
				require_once ('./views/eshop/login.php');
			}
			
		}

		function logout()
		{
			session_unset();
			session_destroy();
			unset($_SESSION['check']);
			header("Location: /php2/app/index.php");
		}

		function signup()
		{
			$actionPOST = filter_input(INPUT_POST,'action');
			if (!empty($actionPOST) || $actionPOST=='signup') 
			{
				$username = filter_input(INPUT_POST,'name');
				$email = filter_input(INPUT_POST,'email');
				$password = filter_input(INPUT_POST,'password');
				$phone = filter_input(INPUT_POST,'phone');
				$NgayLap = new DateTime(null, new DateTimeZone('ASIA/Ho_Chi_Minh'));
				$NgayLap1 = $NgayLap->format('Y-m-d H:i:s');

				if(empty($username) || empty($email) || empty($phone) || empty($password))
				{
					echo '<script>alert("Điền thông tin đăng ký tài khoản!")</script>';
					require_once ('./views/eshop/signup.php');
				}
				else
				{
					$new_user = new User('thanhvien');
					$check = $new_user->checkUser($username);
					if(!$check)
					{
						echo '<script>alert("Tên tài khoản đã tồn tại!")</script>';
						require_once ('./views/eshop/signup.php');
					}
					else
					{
						$data = new Entity();
						$data->username = $username;
						$data->email = $email;
						$data->password = $password;
						$data->phone = $phone;
						$data->level = 0;
						$data->DateJoined = $NgayLap1;
						//var_dump($data);
						$insert_userid = $new_user->insert($data);
						//var_dump($insert_userid);
						if ($insert_userid) {
							header("Location: /php2/app/?controller=index&action=login");
						}
					}
				}
			}
			else 
			{
				require_once ('./views/eshop/signup.php');
			}
		}
		function Page($curPage)
		{
			$data = new Product('loaisanpham');
			$category_re = $data->select();
			$numberRecordPerPage = 9;
			$numberPage	= $data->productperPage($numberRecordPerPage);
			$pro_records = $data->getProductforPage($curPage,$numberRecordPerPage);
			//var_dump($pro_records);
			require_once ('./views/eshop/index.php');
		}

		function redirectPage(){ 
			$url = $_SERVER['REQUEST_URI'];
			if(strlen($url) > 33)
			{
				$url = str_replace('&', '/', $url); 
				$url = str_replace('=', '/', $url); 
				$page = explode("/",$url);
				if($page[5] == "page")
				{
					// echo "1";
					$this->Page($page[6]);
					return true;
				}
				else
				{
					// echo "2";
					return false;
				}
			}
			// echo "2";
			return false;
		}
		function productDetails($key)
		{
            $data = new Product('loaisanpham');
			$category_re = $data->select();
            $where = "MaSanPham=".$key;
            $pro_records = $data->getProduct(1,1,$where);
            require_once ('./views/eshop/product-details.php');
		}
	}
?>