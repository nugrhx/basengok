<div class="container">
	<div class="pt-5">
		<div class="row">
			<?php
			// Fetch data from the dtw table
			$query = $this->db->get('dtw');
			$dtwData = $query->result();

			foreach ($dtwData as $dtw) {
			?>
				<div class="col-sm-4">
					<div class="card">
						<img src="<?php echo base_url('/assets/uploads/images/atv/1.jpg'); ?>" class="card-img-top" alt="">
						<div class="card-body">
							<h5 class="card-title"><strong><?php echo $dtw->nama; ?></strong></h5>
							<p class="card-text pt-2"><?php echo $dtw->deskripsi; ?></p>
							<a href="#" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal">Lihat Detail</a>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalLabel">Carousel Modal</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carousel" data-slide-to="0" class="active"></li>
								<li data-target="#carousel" data-slide-to="1"></li>
								<li data-target="#carousel" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner" role="listbox" style="object-fit: cover; width:100%; height: 640px !important;">
								<div class="carousel-item active">
									<img src="<?php echo base_url('/assets/uploads/images/atv/1.jpg'); ?>" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="<?php echo base_url('/assets/uploads/images/atv/2.jpg'); ?>" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="<?php echo base_url('/assets/uploads/images/atv/3.jpg'); ?>" class="d-block w-100" alt="...">
								</div>
							</div>
							<button class="carousel-control-prev" type="button" data-target="#carousel" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-target="#carousel" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</button>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>