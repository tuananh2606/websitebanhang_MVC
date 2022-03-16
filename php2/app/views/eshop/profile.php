<?php require_once("header.php") ?>

<section id="main-content">
    <section class="wrapper">
	<div style="min-height: 300px;max-width: 1000px;margin: auto;">
	
	<style type="text/css">
		
		.col-md-6{
			color: #293444;
		}

		#user_text{
			color: #6e93ce;
		}
		p{
			color: #6e93ce;
		}

		.details{

			background-color: #eee;
			box-shadow: 0px 0px 10px #aaa;
			width: 100%;
			position: absolute;
			min-height: 100px;
			left: 0px;
			padding: 10px;
			z-index: 2;
		}

		.hide{
			display: none;
		}

	</style>

	<!--profile data-->
<?php if(isset($_SESSION['client'])): 
?>

	<div class="col-md-12" style="flex:1;background-color: #eee;text-align: center;box-shadow: 0px 0px 20px #aaa; border: solid thin #ddd;">
		<div class="container" id="editArea" style="width: 100%; display: none; padding-bottom: 10px;">
			<form action="" method="POST" role="form">
				<legend>Sửa thông tin cá nhân</legend>
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" class="form-control" id="email_Edit">
				</div>
				<div class="form-group">
					<label for="">Số điện thoại</label>
					<input type="text" class="form-control" id="phone_Edit">
				</div>
					<span class="btn btn-success" id="edit2Btn">Lưu</span>
					<span class="btn btn-default" id="cancelEditBtn">Hủy</span>
			</form>
		</div>
		<!-- WHITE PANEL - TOP USER -->
		<div id="user_profile"class="white-panel pn">
			<div class="white-header" style="color:grey">
				<h5>TÀI KHOẢN CỦA TÔI</h5>
			</div>
			<p><img src="./public/eshop/images/blog/man-one.jpg" class="img-circle" width="80"></p>
			<p><b><?php echo $_SESSION['client']['username']?></b></p>
			<div style="margin-top:40px" class="row">
				<div class="col-md-4">
					<p id="user_text" class="small mt">NGÀY ĐĂNG KÝ</p>
					<p><?php echo $_SESSION['client']['DateJoined']?></p>
				</div>
				<div class="col-md-4">
					<p id="user_text" class="small mt">EMAIL</p>
					<p><?php echo $_SESSION['client']['email']?></p>
				</div>
				<div class="col-md-4">
					<p id="user_text" class="small mt">SỐ ĐIỆN THOẠI</p>
					<p><?php echo $_SESSION['client']['phone']?></p>
				</div>

			</div>
			<hr style="color:#888">
			<div class="row">
				<div class="col-md-12">
					<p id="user_text" class="editItemBtn small mt" style="cursor: pointer;color: #13b8ea;" data-e='<?php echo $_SESSION['client']['email']?>' data-p='<?php echo $_SESSION['client']['phone']?>'
					data-id='<?php $_SESSION['client']['thanhvien_id']?>'>
					<i class="fa fa-edit" ></i> SỬA</p>
 				</div>
			</div>

		</div>
	</div><!-- /col-md-4 -->


	<!--end profile data-->

	<br><br style="clear: both;">
	<?php if(isset($_SESSION['client'])):?>

			<table id="user_order" class="table">
				<thead>
					<tr><th>Mã đơn hàng</th><th>Ngày lập đơn hàng</th><th>Tổng tiền</th><th>Địa chỉ giao hàng</th><th>Số điện thoại</th><th>Trạng thái</th></tr>
				</thead>
				<tbody>
				<?php 
				foreach($list_order as $order){
					?>
					<tr>
						<td><?php echo $order->MaDonHang?></td>
						<td><?php echo $order->NgayLap?></td>
						<td><?php echo number_format(($order->TongTien),0,".",".")?>đ</td>
						<td><?php echo $order->DiaChiGiaoHang?></td>
						<td><?php echo $order->Phone?></td>
						<td>
						<?php if ($order->TinhTrang == '2') : ?>
                            <span class="badge badge-danger">Hủy</span>
                        <?php elseif($order->TinhTrang == '1') : ?>
                            <span class="badge badge-success">Đã Giao</span>
						<?php else : ?>
							<span class="badge badge-warning">Đang xử lý</span>
                        <?php endif; ?>
						</td>
					</tr>	
				<?php
					}
				?>
				</tbody>
			</table>
		
	<?php else: ?>
		<h3 style="text-align: center;">Tài khoản chưa có đơn hàng nào!</h3>
	<?php endif;?>
<?php endif;?>

	</div>
	</section>
</section>
<?php require_once("footer.php") ?>
<script>
$('.editItemBtn').on('click',function(){
    $('#editArea').toggle(300);
	$('#user_profile').hide();
	$('#user_order').hide();
	$('#email_Edit').val($(this).attr('data-e'));
	$('#phone_Edit').val($(this).attr('data-p'));
})
$('#cancelEditBtn').on('click',function(){
	$('#editArea').hide();
	$('#user_profile').show(200);
	$('#user_order').show(200);
})

$('#edit2Btn').on('click',function(){
    var Email_update = $('#email_Edit').val();
	var Phone_update = $('#phone_Edit').val();
    $.ajax({
		url : 'index.php/?controller=client&action=updateacc',
        method: 'post',
        data:{Email_up:Email_update,Phone_up:Phone_update},
        success: function(result){
			if(result=="Update Successful!"){

				alert("Cập nhật thành công!");
				location.reload();
			}
			else {
				alert("Lỗi!");
			}
		}
	  });
});
</script>