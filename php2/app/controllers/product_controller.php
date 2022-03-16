<?php
session_start();
require_once("./model/entity.php");
require_once("./model/product.php");
	class product_controller
	{
		function run() {	
			$url = $this-> parseURL();
            $check = count($url);
            //var_dump($url);
			if($url[5] == "category_id")
			{
                if($check > 8)
                {
                    if($url[7] == "page")
                    {
                        $this->Page($url[6],$url[8]);
                    }
                }
                else
				{
                    $this->listbyCategory($url[6]);
                }
                
			}
			else if($url[5] == "product_id")
			{
				$this->productDetails($url[6]);
			}
            else
            {
				header("Location:/php2/app/index.php");
            }
		}


		function listbyCategory($key)
		{
			if(isset($_SESSION['cart']));
			$data = new Product('loaisanpham');
			$category_re = $data->select();
			$where = "MaLoaiSP=".$key;
            $numberRecordPerPage = 9;
            $numberPage	= $data->productperPage($numberRecordPerPage,$where);
            $pro_records = $data->getProductforPage(1,$numberRecordPerPage,$where);
            //var_dump($pro_records);
            // print $numberPage;
            if(count($pro_records)>0)
            {
                require_once ('./views/eshop/category.php');
            }
            else
            {
                require_once ('./views/eshop/empty.php');
            }
		}

        function Page($key,$curPage){
            $data = new Product('loaisanpham');
			$category_re = $data->select();
			$where = "MaLoaiSP=".$key;
            $numberRecordPerPage = 9;
            $numberPage	= $data->productperPage($numberRecordPerPage,$where);
            $pro_records = $data->getProductforPage($curPage,$numberRecordPerPage,$where);
            //var_dump($pro_records);
            // print $numberPage;
            require_once ('./views/eshop/category.php');
        }

		function productDetails($key)
		{
            $data = new Product('loaisanpham');
			$category_re = $data->select();
            $where = "MaSanPham=".$key;
            $pro_records = $data->getProductforPage(1,1,$where);
            require_once ('./views/eshop/product-details.php');
		}


		function parseURL(){
			$url= $_SERVER['REQUEST_URI'];
			$url = str_replace('&', '/', $url); 
			$url = str_replace('=', '/', $url); 
			return explode("/",$url);
		}

    }
?>