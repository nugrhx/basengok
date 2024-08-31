<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label">Judul Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('/assets/uploads/images/atv/1.jpg'); ?>" alt="Gambar 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('/assets/uploads/images/atv/1.jpg'); ?>" alt="Gambar 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('/assets/uploads/images/atv/1.jpg'); ?>" alt="Gambar 3">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!-- Nama -->
        <h5 class="mt-4">Nama Item</h5>
        <!-- Deskripsi -->
        <p>Deskripsi item ini yang menjelaskan detail lebih lanjut tentang apa yang ditampilkan di modal ini.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan perubahan</button>
      </div>
    </div>
  </div>
</div>