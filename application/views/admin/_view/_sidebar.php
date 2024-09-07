<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-2">
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="text-center mt-2">
      <img src="<?= base_url('assets'); ?>//upload/image/logo.png" alt="" class="img-fluid" alt="Responsive image" style="width:80%">
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

        <!-- Sidebar Menu for ADMIN -->
        <li class="nav-item">
          <a href="<?= base_url(); ?>admin" <?php if ($this->uri->segment(2) == "") {
                                              echo 'class="nav-link active"';
                                            } else {
                                              echo 'class="nav-link"';
                                            } ?>>
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">

          <a href="<?= base_url(); ?>admin/dtw" <?php if ($this->uri->segment(2) == "dtw") {
                                                  echo 'class="nav-link active"';
                                                } else {
                                                  echo 'class="nav-link"';
                                                } ?>>
            <i class="fa fa-map nav-icon"></i>
            <p>Daya Tarik Wisata</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url(); ?>admin/amenitas" <?php if ($this->uri->segment(2) == "amenitas") {
                                                        echo 'class="nav-link active"';
                                                      } else {
                                                        echo 'class="nav-link"';
                                                      } ?>>
            <i class="fa fa-book nav-icon"></i>
            <p>Amenitas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url(); ?>admin/kategori" <?php if ($this->uri->segment(2) == "kategori") {
                                                        echo 'class="nav-link active"';
                                                      } else {
                                                        echo 'class="nav-link"';
                                                      } ?>>
            <i class="fa fa-user-alt nav-icon"></i>
            <p>Kategori</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url(); ?>admin/pendukung" <?php if ($this->uri->segment(2) == "pendukung") {
                                                        echo 'class="nav-link active"';
                                                      } else {
                                                        echo 'class="nav-link"';
                                                      } ?>>
            <i class="fa fa-user-alt nav-icon"></i>
            <p>Pendukung</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="<?= base_url(); ?>user" <?php if ($this->uri->segment(2) == "user") {
                                              echo 'class="nav-link active"';
                                            } else {
                                              echo 'class="nav-link"';
                                            } ?>>
            <i class="fa fa-user-alt nav-icon"></i>
            <p>User</p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="<?= base_url('Login/logout'); ?>" class="nav-link">
            <i class="fa fa-power-off nav-icon"></i>
            <p>Log Out</p>
          </a>
        </li>

      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>


<script>
  function preloadImage(url) {
    var img = new Image("<?= base_url('assets'); ?>//upload/image/logo.png");
    img.src = url;
  }
</script>