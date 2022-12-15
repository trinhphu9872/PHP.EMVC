<div class="container">
	<?php if (($_SESSION["errdata"] != '')) : 	?>
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

	<?php if (($_SESSION["editdata"] != '')) : 	?>
		<div style="  color: green;
					width: 50%;
					margin: 0 auto 10px;
					padding: 10px 17px;
					background-color: #32CD32;
					font-weight: bold;
					border-left: 5px solid green;
					display: block;">
			<span><?= ($_SESSION["editdata"]) ?></span>
		</div>
	<?php endif ?>
	<form action="./User/editInfo" method="post">
		<div class="row" style="margin: 0!important">
			<div class="col-md-3"></div>
			<div class="col-md-6" style="margin-bottom: 20px" id="info-user">
				<input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
				<h5><b>Tên tài khoản:</b> <span style="color: grey"><?php echo $_SESSION['user']['username'] ?></span></h5>
				<div class="form-group">
					<label for="">Tên</label>
					<input class="form-control" type="text" value="<?php echo $_SESSION['user']['name'] ?>" name="name">
				</div>
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input class="form-control" type="text" value="<?php echo $_SESSION['user']['addr'] ?>" name="addr">
				</div>
				<div class="form-group">
					<label for="">Số điện thoại</label>
					<input class="form-control" type="text" value="<?php echo $_SESSION['user']['phone'] ?>" name="tel">
				</div>
				<label>Ngày tạo: <span class="label label-primary"><?php echo $_SESSION['user']['createttime'] ?></span></label><br>
				<button type="submit" class="btn btn-success">Lưu</button>
			</div>
		</div>
	</form>
</div>