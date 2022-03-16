<?php require_once("header.php"); ?>

	<section id="form" style="margin-top: 10px"><!--form-->
		<div class="container">
			<div class="row" style="text-align: center;">
				<div class="col-sm-4" style="float: none;display: inline-block;">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản mới!</h2>
						<form method="POST">
							<input name="name" type="text" placeholder="Enter Name"/>
							<input name="email" type="email" placeholder="Enter Email Address"/>
                            <input name="phone" type="text" placeholder="Enter Phone"/>
							<input name="password" type="password" placeholder="Enter Password"/>
							<button name ="action"  value = "signup" class ="btn btn-default">Đăng ký</button>
						</form>
						<br>
						Bạn đã có tài khoản?<a href="/php2/app/?controller=index&action=login"> Đăng nhập</a>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
<?php require_once("footer.php"); ?>






