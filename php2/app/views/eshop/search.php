
<?php 
require_once("header.php");
?>

	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<img src="https://cdn.mediamart.vn/images/banner/m-ban-roler-3118a_651b838a.jpg" style="height:450px;width:100%" class="girl img-responsive" alt="" />
							</div>
							<div class="item">
									<img src="https://cdn.mediamart.vn/images/banner/gia-lnh-khi-lo---sui-to-gia-tt_e27fb76c.jpg" style="height:450px;width:100%" class="girl img-responsive" alt="" />
							</div>
							
							<div class="item">
									<img src="https://cdn.mediamart.vn/images/banner/may-git-lg-ai_3945d472.jpg" style="height:450px;width:100%" class="girl img-responsive" alt="" />
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
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
					
						<div class="advertise_img text-center"><!--brands_products-->
							<img src="https://cdn.mediamart.vn/Banner/dh-casper-box-1nau-an-ngon-re-WmMoWd-vq.jpg" style="width:100%" alt="" />
						</div><!--/brands_products-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="./public/eshop/images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">SẢN PHẨM HIỆN CÓ</h2>
						<?php
							foreach($pro_records as $sp) { 
						?>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
											<div class="productinfo text-center">
												<a href="<?php echo "/php2/app/?controller=product&product_id=".$sp->MaSanPham?>" >
												<img src="<?php echo $sp->HinhAnh?>" style="width:100% ;height:200px" alt="" />
												</a>
												<p><?php echo $sp->TenSanPham?></p>
												<h2><?php echo number_format($sp->GiaSanPham,0,".",".")?>đ</h2>
												<button class="btn btn-default add-to-cart" onclick="addCart('<?php echo $sp->MaSanPham ?>')">
												<i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
									</div>
								</div>
							</div>
						<?php
							}
						?>
					</div>
					<?php if($numberPage > 1) { ?>
						<ul class="pagination">
							<?php 
								for($i=1; $i<=$numberPage; $i++){
							?>
							<li><a href="<?php echo"/php2/app/?controller=search&search=".$search."/page=".$i?>"><?php echo $i ?></a></li>
							<?php 
								}
							?>
						</ul>
					<?php } ?>
				</div>
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

