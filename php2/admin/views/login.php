<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./Public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./Public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./Public/admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>Admin</b></a>
    </div>
    <div class="card-body">

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" id="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <!--<button type="submit" name="action" value="login" class="btn btn-primary btn-block">Sign In</button>-->
			<span id ="loginBtn" class="btn btn-primary btn-block">Sign In</span>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./Public/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./Public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./Public/admin/dist/js/adminlte.min.js"></script>
</body>
</html>
<script>
$('#loginBtn').on('click',function(){
    var username1 = $('#username').val();
	var password1 = $('#password').val();
	if(username1=="" || password1=="")
	{
		alert("Điền thiếu tài khoản hoặc mật khẩu")
	}
	else{
		$.ajax({
		url : 'index.php/?controller=index&action=login',
        method: 'post',
        data:{username:username1,password:password1},
        success: function(result){
			if(result=="Success"){
				alert("Đăng nhập thành công!");
				window.location.href = "/php2/admin/?controller=home";
			}
			else{
				alert("Sai tài khoản hoặc mật khẩu!");
			}
		}
	}); 
	}
});
</script>