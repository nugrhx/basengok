<div class="container">
	<div class="pt-5">
		<div class="row">
			<?php foreach ($amenitas as $card): ?>
				<div class="col-sm-4">
					<div class="card">
						<?php
						$foto_path = 'assets/upload/image/amenitas/' . $card->foto;
						$default_img = 'assets/img/no-image.png';
						$img_src = file_exists($foto_path) && !empty($card->foto) ? $foto_path : $default_img;
						?>
						<img src="<?php echo base_url($img_src); ?>"
							class="card-img-top"
							alt="<?php echo $card->nama; ?>">
						<div class="card-body">
							<h5 class="card-title"><strong><?php echo $card->nama; ?></strong></h5>
							<p class="card-text pt-2">
								<?php echo $card->lokasi; ?>
							</p>
							<p class="text-xs pt-2">
								<?php echo $card->kategori; ?>
							</p>
							<div class="row">
								<div class="col-6">
									<?php if (preg_match('/^08/', $card->kontak)) {
										// Jika kontak dimulai dengan "08", maka dianggap sebagai nomor telepon
										echo '<a class="btn btn-block btn-primary" href="tel:' . $card->kontak . '">Kontak</a>';
									} elseif (preg_match('/^[a-zA-Z]/', $card->kontak)) {
										// Jika kontak dimulai dengan huruf, maka dianggap sebagai email
										echo '<a class="btn btn-block btn-primary" href="mailto:' . $card->kontak . '">Kontak</a>';
									} else {
										// Jika tidak sesuai dengan format di atas, tampilkan kontak apa adanya
										echo '<a class="btn btn-lg btn-block btn-secondary text-xs"  readonly>Belum ada kontak</a>';
									} ?>
								</div>
								<div class="col-6">
									<?php if ($card->kontak != 0) {
										// Jika kontak dimulai dengan "08", maka dianggap sebagai nomor telepon
										echo '<a class="btn btn-block btn-outline-primary" href="' . $card->maps . '" target="_blank">Maps</a>';
									} else {
										// Jika tidak sesuai dengan format di atas, tampilkan kontak apa adanya
										echo '<a class="btn btn-lg btn-block btn-outline-secondary text-xs"  readonly>Belum ada Pin</a>';
									} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
</div>