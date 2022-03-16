<?php require_once("header.php"); ?>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
					<h2>DANH MỤC SẢN PHẨM</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<?php
							foreach( $category_re as $lsp){
						?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="<?php echo"/php2/app/?controller=product&category_id=".$lsp->MaLoaiSP?>"><?php echo $lsp->TenLoaiSP?></a></h4>
								</div>
							</div>
						<?php
							}
						?>
						</div><!--/category-products-->
					</div>
				</div>
				
			<div class="col-sm-9 padding-right"><!--/product-information-->
				<h2 class="title text-center">THÔNG TIN SẢN PHẨM</h2>
				<?php
                    foreach($pro_records as $sp) {
                ?>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="<?php echo $sp->HinhAnh?>" style="width:100% ;height:35%" alt="" />
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information">
								<h2><?php echo $sp->TenSanPham?></h2>
								<p><b>Mã Sản Phẩm:</b> <?php echo $sp->MaSanPham?></p>
								<p><b>Giá:</b> <?php echo number_format($sp->GiaSanPham,0,".",".")?>đ</p>
								<?php if($sp->SoLuongSP> 0) {?>
									<p><b>Tình Trạng:</b> Còn Hàng </p>
									<span>
										<!--<label>Số Lượng:</label>
										<input name ="quantity" type="text" placeholder="1"/>-->							
										<button class="btn btn-fefault cart" onclick="addCart('<?php echo $sp->MaSanPham ?>')">								
										<i class="fa fa-shopping-cart"></i>									
											Add to cart									
										</button>
									</span>
								<?php } else { ?>
									<p><b>Tình Trạng:</b> Hết Hàng</p>
								<?php } ?>
							</div>
						</div>
					</div>



					<?php
						$description = explode("/",$sp->MoTa);
						$arrLength = count($description);
					?>

					<?php if($arrLength>1) { ?>
						<div class="col-sm-8">
							<h2 class="title text-center">THÔNG SỐ SẢN PHẨM</h2>
							<div class="table-responsive">
								<table class="table table-striped table-product">
								<?php 
									for($i = 0; $i < $arrLength;) { 
								?>
									<tbody>
										<tr style="border: 1px solid #ddd;">
											<td> <?php echo $description[$i];?></td>
										</tr>
									</tbody>
								<?php 
									$i=$i+1;
									} 
								?>
								</table>
							</div>
						</div><!--/product-details-->
					<?php } ?>
				<?php
                    }
                ?>
			</div><!--/product-information-->
			</div>
		</div>
	</section>
	
<?php require_once("footer.php"); ?>
<script>
	function addCart(id){
		$.post("index.php?controller=client&action=addtocart",{'id':id},function(data,status){
		location.reload();
	});
	}
</script>