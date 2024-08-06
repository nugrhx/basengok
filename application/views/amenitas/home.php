<div class="container">
	<div class="pt-5">
		<div class="row">
			<?php
			// Fetch data from the dtw table
			$query = $this->db->get('amenitas');
			$amenitasData = $query->result();

			foreach ($amenitasData as $amenitas) {
			?>
				<div class="col-sm-4">
					<div class="card">
						<img src="<?php echo base_url('/assets/uploads/images/atv/1.jpg'); ?>" class="card-img-top" alt="">
						<div class="card-body">
							<h5 class="card-title"><strong><?php echo $amenitas->nama; ?></strong></h5>
							<p class="card-text pt-2"><?php echo $amenitas->lokasi; ?></p>
							<p class="card-text pt-2"><?php echo $amenitas->kategori; ?></p>
							<div class="row">
								<div class="col-6">
									<a href="<?php echo $amenitas->kontak; ?>" class="btn btn-block btn-primary">Kontak</a>
								</div>
								<div class="col-6">
									<a href="<?php echo $amenitas->maps; ?>" target="_blank" class="btn btn-block btn-outline-primary">Maps</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
</div>