<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop</title>
    <link href="./public/eshop/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/eshop/css/font-awesome.min.css" rel="stylesheet">
    <link href="./public/eshop/css/prettyPhoto.css" rel="stylesheet">
    <link href="./public/eshop/css/price-range.css" rel="stylesheet">
    <link href="./public/eshop/css/animate.css" rel="stylesheet">
	<link href="./public/eshop/css/main.css" rel="stylesheet">
	<link href="./public/eshop/css/responsive.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- //./public/eshop/css/bootstrap.min.css -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="./public/eshop/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./public/eshop/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./public/eshop/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./public/eshop/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="./public/eshop/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="/php2/app/?controller=index"><img src="./public/eshop/images/home/logo.png" alt="" /></a>
						</div>
					</div> 
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="/php2/app/?controller=client&action=viewaccount"><i class="fa fa-user"></i> Tài Khoản</a></li>
								<li><a href="/php2/app/?controller=client&action=order"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php if(isset($_SESSION['cart'])){?>
									<?php
										$number = 0;
										foreach($_SESSION['cart'] as $sp){
											$number+=$sp['qty'];
									?>
								<?php
										}
									}
								?>
								<li><a href="/php2/app/?controller=client&action=viewcart"><i class="fa fa-shopping-cart"></i>Giỏ hàng - <?php
								if(isset($_SESSION['cart']) && $number != NULL){echo $number;}
								else{ echo 0;}?></a></li>
								<?php if(empty($_SESSION['check'])):?>
									<li><a href="/php2/app/?controller=index&action=login"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php else: ?>
									<li><a href="/php2/app/?controller=index&action=logout"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">

					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
						<input type="text" placeholder="Search" class="search" onkeydown="search(this)"/>  
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header>

<script>
	function search(ele) {
    if(event.key === 'Enter') {
		window.location.href = "/php2/app/?controller=search&search="+ele.value;
    }
	}
</script>