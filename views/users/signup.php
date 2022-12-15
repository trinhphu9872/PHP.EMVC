<?php if ($_SESSION["errdata"] != '') : ?>
	<div style="  color: red;
					width: 50%;
					margin: 0 auto 10px;
					padding: 10px 17px;
					background-color: #ffbbbb;
					font-weight: bold;
					border-left: 5px solid red;
					display: block;">
		<span><?= $_SESSION["errdata"] ?></span>
	</div>
<?php endif  ?>

<?php if ($_SESSION["sucdata"] != '') : ?>
	<div style="  color: green;
					width: 50%;
					margin: 0 auto 10px;
					padding: 10px 17px;
					background-color: #32CD32;
					font-weight: bold;
					border-left: 5px solid green;
					display: block;">
		<span><?= $_SESSION["sucdata"] ?></span>
	</div>
<?php endif  ?>



<div class="container-fluid form" style="padding: 20px">
	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<form action="./User/register" method="POST">
				<legend>Đăng Ký</legend>
				<div class="form-group">
					<label for="">Tên: </label>
					<input type="text" class="form-control" name="name">
				</div>
				<div class="form-group">
					<label for="">Tên tài khoản: </label>
					<input type="text" class="form-control" name="username">
				</div>
				<div class="form-group">
					<label for="">Mật khẩu: </label>
					<input type="password" class="form-control" name="password">
				</div>
				<div class="form-group">
					<label for="">Nhập lại mật khẩu: </label>
					<input type="password" class="form-control" name="cpassword">
				</div>
				<div class="form-group">
					<label for="">Địa chỉ: </label>
					<input type="text" class="form-control" name="addr">
				</div>
				<div class="form-group">
					<label for="">Số điện thoại: </label>
					<input type="text" class="form-control" name="tel">
				</div>
				<button type="submit" class="btn btn-primary">Đăng kí</button><br><br>

			</form>
		</div>
		<div class="col-lg-12"></div>
	</div>
</div>