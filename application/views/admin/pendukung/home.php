<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">

      <!-- /.card -->
      <div class="card">
        <!-- /.card-header -->
        <div class="card-header">
          <div class="row">
            <div class="col-md-4">
              <button class=" form-control btn btn-success" onclick="add_pendukung()"><i class="fa fa-plus fa-sm"></i> Tambah Data</button>
            </div>
            <!-- <div class="col-md-3">
              <a href="<?php echo base_url('pendukung/export'); ?>" class="form-control btn btn-default"><i class="fa fa-file-excel fa-sm"></i> Export Data Excel</a>
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
                <th>Data Pendukung</th>
                <th style="width:170px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Data Pendukung</th>
                <th style="width:170px;">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<? ?>
<!-- /.js -->
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
        "url": "<?php echo site_url('pendukung/ajax_list') ?>",
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
    table.clear(); // Clear existing data

    files.forEach(function(file) {
      table.row.add([
        file, // Add file name or other relevant data
        // Add other columns as needed
      ]).draw();
    }); //reload datatable ajax 
  }

  function add_pendukung() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data Pendukung'); // Set Title to Bootstrap modal title
  }

  function save() {
    var formData = new FormData($('#form')[0]);

    $.ajax({
      url: "<?php echo site_url('pendukung/ajax_add') ?>", // URL to your PHP controller
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(data) {
        var response = JSON.parse(data);
        if (response.status === 'success') {
          alert('Files uploaded successfully!');
          $('#modal_form').modal('hide');
          reload_table(response.files); // Refresh DataTable with new files
        } else {
          alert('Error uploading files: ' + response.errors.join(', '));
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error uploading files!');
      }
    });
  }

  function edit_pendukung(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url: "<?php echo site_url('pendukung/ajax_edit/') ?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_pen"]').val(data.id_pen);
        $('[name="pendukung"]').val(data.pendukung);
        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit DTW'); // Set title to Bootstrap modal title

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function delete_pendukung(id) {
    if (confirm('Anda yakin ingin menghapus data ini?')) {
      // ajax delete data to database
      $.ajax({
        url: "<?php echo site_url('pendukung/ajax_delete') ?>/" + id,
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