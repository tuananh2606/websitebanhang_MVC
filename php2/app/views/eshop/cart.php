<?php
require_once("header.php") 
?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/php2/app">Home</a></li>
				  <li class="active">Giỏ Hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
					<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản Phẩm</td>
							<td class="description"></td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td id="totalPrice">Thành Tiền</td>
							<td></td>
						</tr>
					</thead>
					<?php if(isset($_SESSION['cart'])){ ?>
						<?php 
							$total = 0;
							foreach ($product as $product_id => $sp){
						?>
					<tbody>
						<tr>
							<td class="cart_product">
								<a href=""><img src="<?php echo $sp['HinhAnh'] ?>" style="width:70px;height:70px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><?php echo $sp['TenSanPham'] ?></a></h4>
								<p>ID: <?php echo $product_id ?></p>
							</td>
							<td class="cart_price">
								<p class="price"><?php echo number_format($sp['GiaSanPham'],0,".",".")?>đ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input onchange="updateCart(<?php echo $product_id ?>)" class="cart_quantity_input" type="text" id="qty_<?php echo $product_id?>" name="qty_<?php echo $product_id?>" value="<?php echo $sp['qty']?>" autocomplete="off" size="2">
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo number_format($sp['GiaSanPham'] * $sp['qty'],0,".",".")?>đ</p>
							</td>
							<td class="cart_delete">
								<a href="index.php?controller=client&action=delete&id=<?php echo $product_id ?>" class="cart_quantity_delete"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					</tbody>
						<?php
							}
					}
						?>
					</table>
						<!--<a href class="btn btn-default update">Update</button>-->
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
					<div class="total_area">
					<?php if(isset($_SESSION['cart'])){ ?>
						<?php
							$total = 0;
							foreach ($product as $product_id => $sp){
								$total+=(int)$sp['GiaSanPham'] * (int)$sp['qty'];
						?>
						<?php
							}
					}
						?>
						<ul>
							<li>Phí Ship <span>Miễn phí</span></li>
							<li>Tổng Tiền<span><?php if(isset($_SESSION['cart']) && $total != NULL){echo number_format($total,0,".",".");}
								else{ echo 0;}?>đ</span></li>
						</ul>
							<a style="margin-left:40px" class="btn btn-default check_out" href="/php2/app/?controller=client&action=order">Đặt Hàng</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
<?php require_once("footer.php"); ?>
<script>
	function updateCart(id){
		qty = $("#qty_"+id).val();
		$.post("index.php?controller=client&action=update",{'id':id,'qty':qty},function(data){
			location.reload();
		});
	}
</script>