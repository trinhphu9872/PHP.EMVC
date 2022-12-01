<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="container-fluid form" style="margin-top: -23px; padding: 20px">
	<div class="row">
		<div class="col-sm-12">
			<div class="main-prd">
				<img src="<?php echo $data['anhchinh'] ?>" class="main-prd-img">
				<div class="basic-info">
					<h2><?php echo $data['tensp'] ?></h2>
					<span class="main-prd-price"><?php echo $data['gia'] ?> VND</span>
					<br><a class="btn btn-primary" href="client/buynow/<?php echo $data['masp'] ?>">Mua ngay</a>
					</ul>
				</div>
			</div>

			<div style="clear: both;"></div>

		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>