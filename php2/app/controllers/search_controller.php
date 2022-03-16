<?php
session_start();
require_once("./model/user.php");
require_once("./model/product.php");
require_once("./model/entity.php");
	class search_controller
	{
		function run() {	
			$url = $this-> parseURL();
            //var_dump($url);
            $check = count($url);
            if($url[5] == "search")
			{
                if($check > 8)
                {
                    if($url[7] == "page")
                    {
                       $this->Page($url[6],$url[8]);
                       //echo "Hello";
                    }
                }
                else
				{
                    $this->listProduct($url[6]);
                }
			}
            else
            {
				header("Location:/php2/app/index.php");
            }
		}

        function listProduct($key)
        {
            //if(isset($_SESSION['cart']));
			$data = new Product('loaisanpham');
			$category_re = $data->select();
			$where = "TenSanPham LIKE'%".$key."%'";
            $numberRecordPerPage = 9;
            $numberPage	= $data->productperPage($numberRecordPerPage,$where);
            $pro_records = $data->getProductforPage(1,$numberRecordPerPage,$where);
            $search = $key;
            //var_dump($pro_records);
            // print $numberPage;
            if(count($pro_records)>0)
            {
                require_once ('./views/eshop/search.php');
            }
            else
            {
                require_once ('./views/eshop/empty.php');
            }
        }

        function Page($key,$curPage){
            $data = new Product('loaisanpham');
			$category_re = $data->select();
			$where = "TenSanPham LIKE'%".$key."%'";
            $numberRecordPerPage = 9;
            $numberPage	= $data->productperPage($numberRecordPerPage,$where);
            $pro_records = $data->getProductforPage($curPage,$numberRecordPerPage,$where);
            $search = $key;
            //var_dump($pro_records);
            // print $numberPage;
            require_once ('./views/eshop/search.php');
        }

        function parseURL(){
			$url= $_SERVER['REQUEST_URI'];
            //echo strlen($url);
			$url = str_replace('&', '/', $url); 
			$url = str_replace('=', '/', $url); 
			return explode("/",$url);
		}
	}


?>