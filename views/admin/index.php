<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Trang quản trị admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.css">
	<script src="public/jquery/jquery-latest.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container-fluid my-5">
	</div>
	<div class="container my-5">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form action='IndexAdmin/login' method="POST">
					<legend>Admin Login</legend>
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
					<div class="form-group">
						<label for="">Tên tài khoản</label>
						<input type="text" class="form-control" name="username">
					</div>
					<div class="form-group">
						<label for="">Mật khẩu</label>
						<input type="password" class="form-control" name="password">
					</div>
					<button type="submit" class="btn btn-primary" ">Đăng Nhập</button>
				</form>
			</div>
		</div>
	</div>
	<script>
		 </script>
</body>

</html>