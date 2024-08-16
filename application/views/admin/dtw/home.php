<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">

      <!-- /.card -->
      <div class="card">
        <!-- /.card-header -->
        <div class="card-header">
          <div class="row">
            <div class="col-md-4">
              <button class=" form-control btn btn-success" data-toggle="modal" data-target="#submit"><i class="fa fa-plus fa-sm"></i> Tambah Data</button>
            </div>
            <!-- 
                  <div class="col-md-3">
                    <a href="<?php echo base_url('dtw/export'); ?>" class="form-control btn btn-default"><i class="fa fa-file-excel fa-sm"></i> Export Data Excel</a>
                  </div>
                  <div class="col-md-2">
                    <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-dtw"><i class="fa fa-file-pdf fa-sm"></i> Cetak PDF</button>
                  </div> -->
          </div>
        </div>
        <!-- /.card-header -->

        <!-- /.card-body -->
        <div class="card-body">
          <table id="table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Foto</th>
                <th style="width:170px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Foto</th>
                <th style="width:170px;">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="submit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Edit</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
          <input type="hidden" value="" name="id_fak" />
          <div class="form-body">
            <div class="form-group has-error">
              <label class="col">Nama</label>
              <div class="col">
                <input name="nama" placeholder="Nama" class="form-control" type="text" required>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group has-error">
              <label class="col">Deskripsi</label>
              <div class="col">
                <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" type="text" rows="5" cols="33" required></textarea>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group has-error">
              <label class="col">Kategori</label>
              <div class="col">
                <select name="kategori" class="form-control" required>
                  <?php
                  $this->db->select('kategori');
                  $this->db->from('kategori');
                  $this->db->where('tipe', 'dtw');
                  $query = $this->db->get();
                  $result = $query->result_array();

                  $options = "";
                  foreach ($result as $row) {
                    $options .= "<option value='" . $row['kategori'] . "'>" . $row['kategori'] . "</option>";
                  }
                  echo $options;
                  ?>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group has-error">
              <label class="col">Lokasi</label>
              <div class="col">
                <input name="lokasi" placeholder="Lokasi" class="form-control" type="text" required>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group has-error">
              <label class="col">Foto</label>
              <div class="col">
                <input name="foto" id="foto" type="file" accept="image/*" required />
                <span class="help-block"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col">
            <button type="button" id="btn_upload" type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- /.js -->
<script type="text/javascript">
  var table;


  $(document).ready(function() {

    $('#submit').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: '<?php echo site_url('dtw/do_upload') ?>',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
          alert("Successful.");
        }
      });
    });

    //datatables
    table = $('#table').DataTable({
      "lengthMenu": [10, 25, 50, 75, 100],
      "order": [
        [0, "desc"]
      ],

      "searching": true,
      "autoWidth": true,

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('Dtw/ajax_list') ?>",
        "type": "POST"
      },

      // //Set column definition initialisation properties.
      // "columnDefs": [{
      //   "targets": [-1], //last column
      //   "orderable": true, //set not orderable
      // }, ],
    });


  });

  // function reload_table() {
  //   table.ajax.reload(null, false); //reload datatable ajax 
  // }

  // function add_dtw() {
  //   // save_method = 'add';
  //   $('#form')[0].reset(); // reset form on modals
  //   $('.form-group').removeClass('has-error'); // clear error class
  //   $('.help-block').empty(); // clear error string
  //   $('#modal_form').modal('show'); // show bootstrap modal
  //   $('.modal-title').text('Form dtw'); // Set Title to Bootstrap modal title
  // }


  // function save() {
  //   $('#btnSave').text('saving...'); //change button text
  //   $('#btnSave').attr('disabled', true); //set button disable 
  //   var url;

  //   if (save_method == 'add') {
  //     url = "<?php echo site_url('dtw/ajax_add') ?>";
  //   } else {
  //     url = "<?php echo site_url('dtw/ajax_update') ?>";
  //   }

  //   // ajax adding data to database
  //   $.ajax({
  //     url: url,
  //     type: "POST",
  //     data: new FormData(this),
  //     processData: false,
  //     contentType: false,
  //     cache: false,
  //     async: false,
  //     success: function(data) {

  //       if (data.status) //if success close modal and reload ajax table
  //       {
  //         $('#modal_form').modal('hide');
  //         alert('Data berhasil disimpan');
  //         reload_table();
  //       } else {
  //         for (var i = 0; i < data.inputerror.length; i++) {
  //           $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
  //           $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
  //         }
  //       }
  //       $('#btnSave').text('save'); //change button text
  //       $('#btnSave').attr('disabled', false); //set button enable 


  //     },
  //     error: function(jqXHR, textStatus, errorThrown) {
  //       alert('Error adding / update data');
  //       $('#btnSave').text('save'); //change button text
  //       $('#btnSave').attr('disabled', false); //set button enable 

  //     }
  //   });
  // }

  // function edit_dtw(id) {
  //   save_method = 'update';
  //   $('#form')[0].reset(); // reset form on modals
  //   $('.form-group').removeClass('has-error'); // clear error class
  //   $('.help-block').empty(); // clear error string

  //   //Ajax Load data from ajax
  //   $.ajax({
  //     url: "<?php echo site_url('dtw/ajax_edit/') ?>/" + id,
  //     type: "GET",
  //     dataType: "JSON",
  //     success: function(data) {
  //       $('[name="id_dtw"]').val(data.id_dtw);
  //       $('[name="nama"]').val(data.nama);
  //       $('[name="deskripsi"]').val(data.deskripsi);
  //       $('[name="kategori"]').val(data.kategori);
  //       $('[name="lokasi"]').val(data.lokasi);
  //       $('[name="foto"]').val(data.foto);
  //       $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
  //       $('.modal-title').text('Edit DTW'); // Set title to Bootstrap modal title

  //     },
  //     error: function(jqXHR, textStatus, errorThrown) {
  //       alert('Error get data from ajax');
  //     }
  //   });
  // }

  // function delete_dtw(id) {
  //   if (confirm('Anda yakin ingin menghapus data ini?')) {
  //     // ajax delete data to database
  //     $.ajax({
  //       url: "<?php echo site_url('dtw/ajax_delete') ?>/" + id,
  //       type: "POST",
  //       dataType: "JSON",
  //       success: function(data) {
  //         //if success reload ajax table
  //         $('#modal_form').modal('hide');
  //         alert('Data berhasil dihapus');
  //         reload_table();
  //       },
  //       error: function(jqXHR, textStatus, errorThrown) {
  //         alert('Gagal menghapus data');
  //       }
  //     });
  //   }
  // }
</script>

<?php //include("modules/modal.php")  
?>