<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">

      <!-- /.card -->
      <div class="card">
        <!-- /.card-header -->
        <div class="card-header">
          <div class="row">
            <div class="col-md-4">
              <button class=" form-control btn btn-success" onclick="add_amenitas()"><i class="fa fa-plus fa-sm"></i> Tambah Data</button>
            </div>
            <!-- <div class="col-md-3">
              <a href="<?php echo base_url('amenitas/export'); ?>" class="form-control btn btn-default"><i class="fa fa-file-excel fa-sm"></i> Export Data Excel</a>
            </div>
            <div class="col-md-3">
              <a href="<?php echo base_url('amenitas/export'); ?>" class="form-control btn btn-default"><i class="fa fa-file-excel fa-sm"></i> Import Data Excel</a>
            </div>
            <div class="col-md-2">
              <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-fakultas"><i class="fa fa-file-pdf fa-sm"></i> Cetak PDF</button>
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
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Kontak</th>
                <th>Maps</th>
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
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Kontak</th>
                <th>Maps</th>
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

<!-- jQuery v3.6.0-->
<script src="<?= base_url('assets'); ?>/vendor/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
  var save_method; //for save method string
  var table;

  $(document).ready(function() {

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
        "url": "<?php echo site_url('amenitas/ajax_list') ?>",
        "type": "POST"
      },

      // //Set column definition initialisation properties.
      // "columnDefs": [{
      //   "targets": [-1], //last column
      //   "orderable": true, //set not orderable
      // }, ],
    });
  });

  function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
  }

  function add_amenitas() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Form Fakultas'); // Set Title to Bootstrap modal title
  }


  function save() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable 
    var url;

    if (save_method == 'add') {
      url = "<?php echo site_url('amenitas/ajax_add') ?>";
    } else {
      url = "<?php echo site_url('amenitas/ajax_update') ?>";
    }

    var formData = new FormData($('#form')[0]); // Menggunakan FormData untuk menangani file upload

    // ajax adding data to database
    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      contentType: false, // Penting untuk diatur saat menggunakan FormData
      processData: false, // Penting untuk diatur saat menggunakan FormData
      dataType: "JSON",
      success: function(data) {

        if (data.status) //if success close modal and reload ajax table
        {
          $('#modal_form').modal('hide');
          alert('Data berhasil disimpan');
          reload_table();
        } else {
          for (var i = 0; i < data.inputerror.length; i++) {
            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
          }
        }
        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 


      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 

      }
    });
  }

  function edit_amenitas(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url: "<?php echo site_url('amenitas/ajax_edit/') ?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_amn"]').val(data.id_amn);
        $('[name="nama"]').val(data.nama);
        $('[name="lokasi"]').val(data.lokasi);
        $('[name="kategori"]').val(data.kategori);
        $('[name="kontak"]').val(data.kontak);
        $('[name="maps"]').val(data.maps);

        // Jika ada data foto, tampilkan di modal (misalnya, preview gambar)
        if (data.foto) {
          $('#foto-preview').show(); // Pastikan elemen untuk preview foto ada
          $('#foto-preview').attr('src', "<?php echo base_url('assets/upload/image/dtw/') ?>" + data.foto);
        } else {
          $('#foto-preview').hide(); // Sembunyikan jika tidak ada foto
        }

        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit fakultas'); // Set title to Bootstrap modal title

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function delete_amenitas(id) {
    if (confirm('Anda yakin ingin menghapus data ini?')) {
      // ajax delete data to database
      $.ajax({
        url: "<?php echo site_url('amenitas/ajax_delete') ?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          //if success reload ajax table
          $('#modal_form').modal('hide');
          alert('Data berhasil dihapus');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Gagal menghapus data');
        }
      });
    }
  }
</script>

<?php include("modules/modal.php")  ?>