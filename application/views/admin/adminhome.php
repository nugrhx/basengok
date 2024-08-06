        <?php //var_dump($this->userdata)
        ?>
        <div class="container-fluid">
          <div class="row">
            <!-- ./small card -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>
                    <?php echo $j_Dtw ?></h3>
                  <p>Daya Tarik Wisata</p>
                </div>
                <div class="icon">
                  <i class="fa fa-solid fa-map fa-xl"></i>
                </div>
                <a href="<?= base_url(); ?>admin/dtw" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./small card -->
            <div class="col-lg-4  col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $j_Amn ?></h3>
                  <p>Amenitas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-solid fa-book fa-xl"></i>
                </div>
                <a href="<?= base_url(); ?>admin/amenitas" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./small card -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo $j_Kat ?></h3>
                  <p>Data Kategori</p>
                </div>
                <div class="icon">
                  <i class="fa fa-solid fa-book fa-xl"></i>
                </div>
                <a href="<?= base_url(); ?>admin/kategori" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <!--<section class="col-lg-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Latest Members</h3>

              <div class="card-tools">
                <span class="badge badge-danger">8 New Members</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-3">
              <ul class="users-list clearfix">
                <li>
                  <img src="<?= base_url("assets/vendor/"); ?>img/user1-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Alexander Pierce</a>
                  <span class="users-list-date">Today</span>
                </li>
                <li>
                  <img src="<?= base_url("assets/vendor/"); ?>img/user8-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Norman</a>
                  <span class="users-list-date">Yesterday</span>
                </li>
                <li>
                  <img src="<?= base_url("assets/vendor/"); ?>img/user7-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Jane</a>
                  <span class="users-list-date">12 Jan</span>
                </li>
                <li>
                  <img src="<?= base_url("assets/vendor/"); ?>img/user6-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">John</a>
                  <span class="users-list-date">12 Jan</span>
                </li>
                <li>
                  <img src="<?= base_url("assets/vendor/"); ?>img/user2-160x160.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Alexander</a>
                  <span class="users-list-date">13 Jan</span>
                </li>
                <li>
                  <img src="<?= base_url("assets/vendor/"); ?>img/user5-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Sarah</a>
                  <span class="users-list-date">14 Jan</span>
                </li>
                <li>
                  <img src="<?= base_url("assets/vendor/"); ?>img/user4-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Nora</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
                <li>
                  <img src="<?= base_url("assets/vendor/"); ?>img/user3-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Yena</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
              </ul>
            </div>
            <div class="card-footer text-center">
              <a href="javascript:">View All Users</a>
            </div>
          </div>
          </section>-->
        </div>
        </div>