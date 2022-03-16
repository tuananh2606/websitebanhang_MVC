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
            <h1>DANH SÁCH ĐƠN HÀNG</h1>
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
					<div class="container" id="editArea" style="width: 100%; display: none; padding-bottom: 10px;">
						<form action="" method="POST" role="form">
							<legend>Sửa giao dịch</legend>
							<i id="addError" style="color: red"></i>
							<div class="form-group">
								<label for="">Tên khách hàng</label>
								<input type="text" class="form-control" id="orderName_Edit">
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="text" class="form-control" id="orderEmail_Edit">
							</div>
							<div class="form-group">
								<label for="">Số điện thoại</label>
								<input type="text" class="form-control" id="orderPhone_Edit">
							</div>
							<div class="form-group">
								<label for="">Địa chỉ giao hàng</label>
								<input type="text" class="form-control" id="orderAddress_Edit">
							</div>
							<div class="form-group">
								<label for="">Trạng thái</label>
								<input type="text" class="form-control" id="orderStatus_Edit">
							</div>
								<span class="btn btn-success" id="edit2Btn">Lưu</span>
								<span class="btn btn-default" id="cancelEditBtn">Hủy</span>
						</form>
					</div>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
					<th>STT</th>
					<th>Mã Đơn Hàng</th>
					<th>Trạng Thái</th>
                    <th>Tên Khách Hàng</th>
					<th>Email</th>
					<th>SĐT</th>
					<th>Ngày Lập</th>
					<th>Địa Chỉ</th>
					<th>Tổng Tiền</th>
					<th>Hành Động</th>
                  </tr>
                  </thead>
                  <tbody>
					<?php
						$count = 0;
						foreach($list_giaodich as $giaodich) {
							?>
							<tr>
							<td><?php echo $count + 1 ?></td>
							<td><?php echo $giaodich->MaDonHang?></td>
							<td class="text-center">
								<?php if ($giaodich->TinhTrang == '2') : ?>
                                       <span class="badge badge-danger">Hủy</span>
                                <?php elseif($giaodich->TinhTrang == '1') : ?>
                                       <span class="badge badge-success">Đã Giao</span>
								<?php else : ?>
										<span class="badge badge-warning">Đang xử lý</span>
                                <?php endif; ?>
							</td>
							<td><?php echo $giaodich->TenKhachHang?></td>
							<td><?php echo $giaodich->Email?></td>
							<td><?php echo $giaodich->Phone?></td>
							<td><?php echo $giaodich->NgayLap?></td>
							<td><?php echo $giaodich->DiaChiGiaoHang?></td>
							<td><?php echo number_format(($giaodich->TongTien),0,".",".")?>đ</td>
							<td class="text-center">
							 <?php if (!($giaodich->TinhTrang == '1')){ ?>
								<span class="btn btn-primary btn-sm editItemBtn" data-id='<?php echo $giaodich->MaDonHang?>' data-st='<?php echo $giaodich->TinhTrang?>'>Chỉnh sửa</span>
								<span class="btn btn-danger btn-sm delItemBtn" data-id='<?php echo $giaodich->MaDonHang?>'>Xóa</span>
							 <?php } ?>
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
$('.delItemBtn').on('click',function(){
    var cf = confirm('Bạn chắc chứ?');
    if(cf){
      var id = $(this).data('id');
      $.ajax({
		url : 'index.php/?controller=giaodich&action=deletebyid',
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
$('.editItemBtn').on('click',function(){
    $('#editArea').toggle(300);
	$('#example2').toggle();
	$('#edit2Btn').attr('data-id',$(this).data('id'));
	$('#orderName_Edit').val($(this).closest('tr').children('td:nth-child(4)').text());
	$('#orderEmail_Edit').val($(this).closest('tr').children('td:nth-child(5)').text());
	$('#orderPhone_Edit').val($(this).closest('tr').children('td:nth-child(6)').text());
	$('#orderAddress_Edit').val($(this).closest('tr').children('td:nth-child(8)').text());
	$('#orderStatus_Edit').val($(this).attr('data-st'));
  })
$('#cancelEditBtn').on('click',function(){
    $('#editArea').toggle(300);
	$('#example2').toggle();
})

$('#edit2Btn').on('click',function(){
	var id = $(this).data('id');
    var orderName_update = $('#orderName_Edit').val();
	var orderEmail_update = $('#orderEmail_Edit').val();
	var orderPhone_update = $('#orderPhone_Edit').val();
	var orderAddress_update = $('#orderAddress_Edit').val();
	var orderStatus_update = $('#orderStatus_Edit').val();
    $.ajax({
		url : 'index.php/?controller=giaodich&action=update',
        method: 'post',
        data:{ID_up:id,Name_up:orderName_update,Email_up:orderEmail_update,Phone_up:orderPhone_update,Address_up:orderAddress_update,Status_up:orderStatus_update,},
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