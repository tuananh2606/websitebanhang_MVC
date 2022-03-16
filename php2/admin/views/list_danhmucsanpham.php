<?php
	require_once("header.php");
 ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DANH MỤC SẢN PHẨM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/php2/admin/?controller=home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Danh mục sản phẩm</li>
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
						 <button type="button" id="addBtn" class="btn btn-primary">Thêm danh mục</button>
					</div>
					<div class="container" id="addArea" style="width: 100%; display: none; padding-bottom: 10px;">
						<p id="message" class="text-dark"></p>
						<legend>Thêm danh mục sản phẩm</legend>
						<form id = "formAdd" action="" method="POST" role="form">
							<i id="addError" style="color: red"></i>
							<div class="form-group">
								<label for="">Tên danh mục</label>
								<input type="text" class="form-control" id="Category_dmsp">
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
								<label for="">Tên danh mục</label>
								<input type="text" class="form-control" id="categoryname_Edit">
							</div>
								<span class="btn btn-success" id="edit2Btn">Lưu</span>
								<span class="btn btn-default" id="cancelEditBtn">Hủy</span>
						</form>
					</div>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
					<th>STT</th>
                    <th>Mã loại sản phẩm</th>
                    <th>Tên loại sản phẩm</th>
                    <th>Hành động</th>
                  </tr>
                  </thead>
                  <tbody>
					<?php
						$count = 0;
						foreach($list_danhmucsanpham as $danhmucsp) {
							?>
							<tr>
							<td><?php echo $count + 1 ?></td>
							<td><?php echo $danhmucsp->MaLoaiSP?></td>
							<td><?php echo $danhmucsp->TenLoaiSP?></td>
							<td class="text-center">
									<span class="btn btn-primary btn-sm editItemBtn" data-id='<?php echo $danhmucsp->MaLoaiSP?>'>Chỉnh sửa</span>
									<span class="btn btn-danger btn-sm delItemBtn" data-id='<?php echo $danhmucsp->MaLoaiSP?>'>Xóa</span>
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
    var category_dmsp = $('#Category_dmsp').val();
	$.ajax({
		url : 'index.php/?controller=danhmucsp&action=add',
        method: 'post',
        data:{danhmucsp_add:category_dmsp},
        success: function(result){
			if(result=="Insert Successful!"){
				alert("Thêm thành công!");
				location.reload();
			}
			else {
				alert("Lỗi!");
			}
		}
	})	
   })
</script>
<script>
$('.delItemBtn').on('click',function(){
    var cf = confirm('Bạn chắc chứ?');
    if(cf){
      var id = $(this).data('id');
      $.ajax({
		url : 'index.php/?controller=danhmucsp&action=deletebyid',
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
	  }) 
    }
})
</script>
<script>
$('.editItemBtn').on('click',function(){
    $('#editArea').toggle(300);
	$('#example2').toggle();
	$('#edit2Btn').attr('data-id',$(this).data('id'));
	$('#categoryname_Edit').val($(this).closest('tr').children('td:nth-child(3)').text());
  })
$('#cancelEditBtn').on('click',function(){
    $('#editArea').toggle(300);
	$('#example2').toggle();
})

$('#edit2Btn').on('click',function(){
	var id = $(this).data('id');
    var categoryName_update = $('#categoryname_Edit').val();
	console.log(id,categoryName_update);
    $.ajax({
		url : 'index.php/?controller=danhmucsp&action=update',
        method: 'post',
        data:{ID_up:id,CategoryName_up:categoryName_update},
        success: function(result){
			if(result=="Update Successful!"){
				alert("Cập nhật thành công!");
				location.reload();
			}
			else {
				alert("Lỗi!");
			}
		}
	  })
})
</script>