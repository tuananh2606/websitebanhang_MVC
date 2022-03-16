<?php require_once("header.php"); ?>

	<section id="form" style="margin-top: 10px"><!--form-->
		<div class="container">
			<div class="row" style="text-align: center;">
				<div class="col-sm-4" style="float: none;display: inline-block;">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập vào tài khoản của bạn</h2>
						<form method="POST">
							<input name="username" id="username1" type="text" placeholder="Username" />
							<input name="password" id="password1" type="password" placeholder="Password" />
							<button name="action" type="submit"  value="login" class="btn btn-default loginBtn">Đăng nhập</button>
						</form>
						<br>
						Bạn chưa có tài khoản?<a href="/php2/app/?controller=index&action=signup"> Đăng ký</a>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
<?php require_once("footer.php"); ?>