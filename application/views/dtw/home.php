<div class="container">
	<div class="pt-5">
		<div class="row">
			<?php foreach ($dtw as $card): ?>
				<div class="col-sm-4">
					<div class="card">
						<img src="<?php echo base_url('assets/upload/image/dtw/' . $card->foto); ?>" class="card-img-top" alt="<?php echo $card->nama; ?>">
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

<!-- jQuery v3.6.0-->
<script src="<?= base_url('assets'); ?>/vendor/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		// Ketika tombol "Lihat Detail" diklik
		$('[data-toggle="modal"]').on('click', function() {
			var id_dtw = $(this).data('id_dtw');

			$.ajax({
				url: "<?php echo site_url('home/dtw_detail/') ?>/" + id_dtw,
				type: "GET",
				dataType: "JSON",
				success: function(data) {
					console.log(data); // Cek data di console

					// Mengisi konten modal dengan data yang diterima
					var content = '<img src="<?php echo base_url('assets/upload/image/dtw/') ?>' + data.foto + '" class="img-fluid" alt="' + data.nama + '" style="max-width: 100%; height: auto;" />';
					content += '<h5><strong>' + data.nama + '</strong></h5>';
					content += '<p><strong>Deskripsi:</strong> ' + data.deskripsi + '</p>';
					content += '<p><strong>Lokasi:</strong> ' + data.lokasi + '</p>';
					content += '<p><strong>Kategori:</strong> ' + data.kategori + '</p>';

					$('#modal-body-content').html(content);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('#modal-body-content').html('<p>Terjadi kesalahan dalam memuat data.</p>');
				}
			});
		});
	});
</script>


<?php include("modules/modal.php")  ?>