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
            <h1>DANH SÁCH THÀNH VIÊN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/php2/admin/?controller=home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Danh sách thành viên</li>
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
						 <button type="button" id="addBtn" class="btn btn-primary">Thêm thành viên</button>
					</div>
					<div class="container" id="addArea" style="width: 100%; display: none; padding-bottom: 10px;">
						<p id="message" class="text-dark"></p>
						<legend>Thêm thành viên</legend>
						<form id = "formAdd" action="" method="POST" role="form">
							<i id="addError" style="color: red"></i>
							<div class="form-group">
								<label for="">Username</label>
								<input type="text" class="form-control" id="Username_tv">
								<label for="">Password</label>
								<input type="text" class="form-control" id="Password_tv">
								<label for="">Level</label>
								<input type="text" class="form-control" id="Level_tv">
							</div>

							<span class="btn btn-success" id="add2Btn">Thêm</span>
							<span class="btn btn-default" id="cancelAddBtn">Hủy</span>
						</form>
					</div>
					<div class="container" id="editArea" style="width: 100%; display: none; padding-bottom: 10px;">
						<form action="" method="POST" role="form">
							<legend>Sửa thành viên</legend>
							<i id="addError" style="color: red"></i>
							<div class="form-group">
								<label for="">Password</label>
								<input type="text" class="form-control" id="userpass_Edit">
							</div>
							<div class="form-group">
								<label for="">Level</label>
								<input type="text" class="form-control" id="userlevel_Edit">
							</div>
								<span class="btn btn-success" id="edit2Btn">Lưu</span>
								<span class="btn btn-default" id="cancelEditBtn">Hủy</span>
						</form>
					</div>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
					<th>STT</th>
                    <th>Mã thành viên</th>
                    <th>Tài khoản</th>
                    <th>Mật khẩu</th>
                    <th>Quyền</th>
                    <th>Hành động</th>
                  </tr>
                  </thead>
                  <tbody>
					<?php
						$count = 0;
						foreach($list_thanhvien as $thanhvien) {
							?>
							<tr>
							<td><?php echo $count + 1 ?></td>
							<td><?php echo $thanhvien->thanhvien_id?></td>
							<td><?php echo $thanhvien->username?></td>
							<td><?php echo $thanhvien->password?></td>
							<td><?php echo $thanhvien->level?></td>
							<td class="text-center">
									<span class="btn btn-primary btn-sm editItemBtn" data-id='<?php echo $thanhvien->thanhvien_id?>'>Chỉnh sửa</span>
									<span class="btn btn-danger btn-sm delItemBtn" data-id='<?php echo $thanhvien->thanhvien_id?>'>Xóa</span>
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
    var user_tv = $('#Username_tv').val();
	var password_tv = $('#Password_tv').val();
	var level_tv = $('#Level_tv').val();
	$.ajax({
		url : 'index.php/?controller=thanhvien&action=add',
        method: 'post',
        data:{taikhoan_tv:user_tv,matkhau_tv:password_tv,quyen_tv:level_tv},
        success: function(result){
			alert("Thêm thành công!");
			location.reload();
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
		url : 'index.php/?controller=thanhvien&action=deletebyid',
        method: 'post',
        data:{delete_id:id},
        success: function(result){
			alert("Xóa thành công!");
			location.reload();
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
	$('#userpass_Edit').val($(this).closest('tr').children('td:nth-child(4)').text());
	$('#userlevel_Edit').val($(this).closest('tr').children('td:nth-child(5)').text());
  })
$('#cancelEditBtn').on('click',function(){
    $('#editArea').toggle(300);
	$('#example2').toggle();
})

$('#edit2Btn').on('click',function(){
	var id = $(this).data('id');
    var userpass_update = $('#userpass_Edit').val();
	var userlevel_update = $('#userlevel_Edit').val();
    $.ajax({
		url : 'index.php/?controller=thanhvien&action=update',
        method: 'post',
        data:{ID_up:id,Userpasstv_up:userpass_update,Leveltv_up:userlevel_update},
        success: function(result){
			alert("Cập nhật thành công!");
			location.reload();
		}
	  })
})
</script>