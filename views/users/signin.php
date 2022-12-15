<div class="container-fluid form" style="padding: 20px">
	<?php if (($_SESSION["errdata"]) != '') : ?>
		<div style="  color: red;
					width: 50%;
					margin: 0 auto 10px;
					padding: 10px 17px;
					background-color: #ffbbbb;
					font-weight: bold;
					border-left: 5px solid red;
					display: block;">
			<span><?= ($_SESSION["errdata"]) ?></span>
		</div>
	<?php endif ?>

	<?php if ((($_SESSION["sucdata"])) != '') : ?>
		<div style="  color: green;
					width: 50%;
					margin: 0 auto 10px;
					padding: 10px 17px;
					background-color: #32CD32;
					font-weight: bold;
					border-left: 5px solid green;
					display: none;">
			<span><?= ($_SESSION["sucdata"]) ?></span>
		</div>
	<?php endif  ?>
	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<form action="./User/login" method="POST" role="form">
				<legend>Đăng Nhập</legend>

				<div class="form-group">
					<label for="">Tên tài khoản: </label>
					<input type="text" class="form-control" name="username" id="username">
				</div>
				<div class="form-group">
					<label for="">Mật khẩu: </label>
					<input type="password" class="form-control" name="password" id="password">
				</div>
				<button class="btn btn-primary">Đăng nhập</button><br><br>
				<a href="User/signup" style="float: right;">Tạo tài khoản mới</a><br><br>
			</form>
		</div>
		<div class="col-lg-12"></div>
	</div>
</div>