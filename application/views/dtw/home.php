<div class="container">
	<div class="pt-5">
		<div class="row">
			<?php foreach ($dtw as $card): ?>
				<div class="col-sm-4">
					<div class="card">
						<img src="<?php echo base_url('/assets/uploads/images/atv/1.jpg'); ?>" class="card-img-top" alt="">
						<div class="card-body">
							<h5 class="card-title"><strong><?php echo $card->nama; ?></strong></h5>
							<p class="card-text pt-2">
								<?php
								$string = $card->deskripsi;
								$desc = character_limiter($string, 100);
								echo $desc;
								?>
							</p>
							<a href="#" class="btn btn-block btn-primary"
								data-toggle="modal"
								data-target="#modal"
								data-id_dtw="<?php echo $card->id_dtw; ?>">
								Lihat Detail
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php include("modules/modal.php")  ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>