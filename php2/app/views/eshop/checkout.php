<?php require_once "header.php"; ?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive cart_info">
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu">
										<td class="image">Item</td>
										<td class="description"></td>
										<td class="price">Price</td>
										<td class="quantity">Quantity</td>
										<td class="total">Total</td>
										<td></td>
									</tr>
								</thead>
								<?php if(isset($_SESSION['cart'])){ ?>
									<?php 
									foreach($product as $product_id => $sp){
									?>
								<tbody>
									<tr>
										<td class="cart_product">
											<a href=""><img src="<?php echo $sp['HinhAnh'] ?>" style="width:70px;height:70px;margin-right:70px" alt=""></a>
										</td>
										<td class="cart_description">
											<h4 id="productName"><?php echo $sp['TenSanPham'] ?></h4>
											<p>ID: <?php echo $product_id ?></p>
										</td>
										<td class="cart_price">
											<p><?php echo number_format($sp['GiaSanPham'],0,".",".")?>đ</p>
										</td>
										<td class="cart_quantity">
											<p style="font-size:18px;margin-left:25px"><?php echo $sp['qty'] ?></p>
										</td>
										<td class="cart_total">
											<p class="cart_total_price"><?php echo number_format($sp['GiaSanPham'] * $sp['qty'],0,".",".")?>đ</p></p>
										</td>
									</tr>
								</tbody>
								<?php
									}
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-7">
				</div>
				<div class="col-sm-5 clearfix">
					<div class="bill-to">
							<p>THÔNG TIN CHI TIẾT</p>
							<div class="form-one" style="width:100%">
								<form>
									<input type="text" id="checkout_Name" placeholder="Họ tên">
									<input type="email" id="checkout_Email" placeholder="Email">
									<input type="text" id="checkout_Phone" placeholder="Số điện thoại">
									<input type="text" id="checkout_Address" placeholder="Địa chỉ">
								</form>
								<span id="checkout" class="btn btn-primary">Thanh Toán</span>
							</div>
						</div>
				</div>				
			</div>
		</div>
	</section>
<?php require_once("footer.php"); ?>
<script>
$('#checkout').on('click',function()
{
	var Name = $('#checkout_Name').val();
	var Email = $('#checkout_Email').val();
	var Phone = $('#checkout_Phone').val();
    var Address = $('#checkout_Address').val();
    $.ajax({
		url : 'index.php/?controller=client&action=saveorder',
        method: 'post',
        data:{Name_add:Name,Email_add:Email,Phone_add:Phone,Address_add:Address},
		success: function(result){
			if(result){
				window.location.href = "/php2/app/?controller=client&action=ordercomplete";
			}
		}
	})
});
</script>