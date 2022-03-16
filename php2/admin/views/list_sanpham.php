<?php
	require_once("header.php");
	require_once(ROOTDIR.'/models/model.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DANH SÁCH SẢN PHẨM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/php2/admin/?controller=home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Danh sách sản phẩm</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <!-- /.card-header -->
			   <div class="card-body">
					<div class="container" style="margin: 10px 0;">
						 <button type="button" id="addBtn" class="btn btn-primary">Thêm sản phẩm</button>
					</div>
					<div class="container" id="addArea" style="width: 100%; display: none; padding-bottom: 10px;">
						<p id="message" class="text-dark"></p>
						<form id = "formAdd" action="" method="POST" role="form">
							<legend>Thêm sản phẩm</legend>
							<i id="addError" style="color: red"></i>
							<div class="form-group">
								<label for="">Mã loại sản phẩm</label>
								<input type="text" class="form-control" id="category_Id">
								<label for="">Tên sản phẩm</label>
								<input type="text" class="form-control" id="productName">
								<label for="">Hình ảnh sản phẩm</label>
								<input type="text" class="form-control" id="productImage">
								<label for="">Mô tả sản phẩm</label>
								<input type="text" class="form-control" id="productDescrip">
								<label for="">Số lượng sản phẩm</label>
								<input type="text" class="form-control" id="productQuantity">
								<label for="">Giá sản phẩm</label>
								<input type="text" class="form-control" id="productPrice">
							</div>

							<span class="btn btn-success" id="add2Btn">Thêm</span>
							<span class="btn btn-default" id="cancelAddBtn">Hủy</span>
						</form>
					</div>
					<div class="container" id="editArea" style="width: 100%; display: none; padding-bottom: 10px;">
						<form action="" method="POST" role="form">
							<legend>Sửa danh mục</legend>
							<i id="addError" style="color: red"></i>
							<div class="form-group">
								<label for="">Tên sản phẩm</label>
								<input type="text" class="form-control" id="productName_Edit">
							</div>
							<div class="form-group">
								<label for="">Hình ảnh sản phẩm</label>
								<input type="text" class="form-control" id="productImage_Edit" placeholder="Image URL">
							</div>
							<div class="form-group">
								<label for="">Mô tả sản phẩm</label>
								<input type="text" class="form-control" id="productDescrip_Edit">
							</div>
							<div class="form-group">
								<label for="">Số lượng</label>
								<input type="text" class="form-control" id="productQuantity_Edit">
							</div>
							<div class="form-group">
								<label for="">Giá sản phẩm</label>
								<input type="text" class="form-control" id="productPrice_Edit">
							</div>
								<span class="btn btn-success" id="edit2Btn">Lưu</span>
								<span class="btn btn-default" id="cancelEditBtn">Hủy</span>
						</form>
					</div>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
					<th>STT</th>
                    <th>Mã sản phẩm</th>
					<th>Mã loại sản phẩm</th>
                    <th>Tên sản phẩm</th>
					<th>Link ảnh sản phẩm</th>
					<th>Mô Tả</th>
                    <th>Số lượng</th>
                    <th>Giá sản phẩm</th>
                    <th>Hành động</th>
                  </tr>
                  </thead>
                  <tbody>
					<?php
						$count = 0;
						foreach($list_sanpham as $sanpham) {
							?>
							<tr>
							<td><?php echo $count + 1 ?></td>
							<td><?php echo $sanpham->MaSanPham?></td>
							<td><?php echo $sanpham->MaLoaiSP?></td>
							<td><?php echo $sanpham->TenSanPham?></td>
							<td><?php echo $sanpham->HinhAnh?></td>
							<td><?php echo $sanpham->MoTa?></td>
							<td><?php echo $sanpham->SoLuongSP?></td>
							<td><?php echo $sanpham->GiaSanPham?></td>
							<td class="text-center">
								<span class="btn btn-primary btn-sm editItemBtn" data-id='<?php echo $sanpham->MaSanPham?>'>Chỉnh sửa</span>
								<span class="btn btn-danger btn-sm delItemBtn" data-id='<?php echo $sanpham->MaSanPham?>'>Xóa</span>
							</td>
							</tr>
							<?php $count = $count + 1;?>
							<?php
						}
					?>
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php
	require_once("footer.php");
?>
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
$('#addBtn').on('click',function(){
    $('#addArea').toggle(300);
})
$('#cancelAddBtn').on('click',function(){
    $('#addArea').toggle(300);
})
$('#add2Btn').on('click',function()
   {
	var category_ID = $('#category_Id').val();
    var productajax = $('#productName').val();
	var productimage = $('#productImage').val();
	var productdescrip = $('#productDescrip').val();
	var productSL = $('#productQuantity').val();
	var productGia = $('#productPrice').val();
	$.ajax({
		url : 'index.php/?controller=sanpham&action=add',
        method: 'post',
        data:{product_ct_id:category_ID,productName1:productajax,productHinhAnh:productimage,productMoTa:productdescrip,productSoluong:productSL,productGia1:productGia},
        success: function(result){
			if(result=="Insert Successful!"){
				alert("Thêm thành công!")
				location.reload()
			}
			else{
				alert("Lỗi!")
			}
		}
	});	
});
</script>
<script>
$('.delItemBtn').on('click',function(){
    var cf = confirm('Bạn chắc chứ?');
    if(cf){
      var id = $(this).data('id');
      $.ajax({
		url : 'index.php/?controller=sanpham&action=deletebyid',
        method: 'post',
        data:{delete_id:id},
        success: function(result){
			if(result=="Delete Successful!"){
				alert("Xóa thành công!");
				location.reload();
			}
			else {
				alert("Lỗi!");
			}
		}
	  }); 
    }
});
</script>
<script>
$('.editItemBtn').on('click',function(){
    $('#editArea').toggle(300);
	$('#example2').toggle();
	$('#edit2Btn').attr('data-id',$(this).data('id'));
	$('#productName_Edit').val($(this).closest('tr').children('td:nth-child(4)').text());
	$('#productImage_Edit').val($(this).closest('tr').children('td:nth-child(5)').text());
	$('#productDescrip_Edit').val($(this).closest('tr').children('td:nth-child(6)').text());
	$('#productQuantity_Edit').val($(this).closest('tr').children('td:nth-child(7)').text());
	$('#productPrice_Edit').val($(this).closest('tr').children('td:nth-child(8)').text());
  })
$('#cancelEditBtn').on('click',function(){
    $('#editArea').toggle(300);
	$('#example2').toggle();
})

$('#edit2Btn').on('click',function(){
	var id = $(this).data('id');
    var productName_update = $('#productName_Edit').val();
	var productImage_update = $('#productImage_Edit').val();
	var productDescrip_update = $('#productDescrip_Edit').val();
	var productQuantity_update = $('#productQuantity_Edit').val();
    var productPrice_update = $('#productPrice_Edit').val();
    $.ajax({
		url : 'index.php/?controller=sanpham&action=update',
        method: 'post',
        data:{ID_up:id,TenSP_up:productName_update,HinhAnhSP_up:productImage_update,MoTa_up:productDescrip_update,SL_up:productQuantity_update,Gia_up:productPrice_update},
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