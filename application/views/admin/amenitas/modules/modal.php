    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Person Form</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
              <input type="hidden" value="" name="id_amn" />
              <div class="form-body">
                <div class="form-group has-error">
                  <label class="col">Nama Amenitas</label>
                  <div class="col">
                    <input name="nama" placeholder="Nama Amenitas" class="form-control" type="text" required>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group has-error">
                  <label class="col">Lokasi Amenitas</label>
                  <div class="col">
                    <input name="lokasi" placeholder="Lokasi Amenitas" class="form-control" type="text" required>
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
                      $this->db->where('tipe', 'amenitas');
                      $query = $this->db->get();
                      $result = $query->result_array();

                      $options = "";
                      foreach ($result as $row) {
                        $options .= "<option value='" . $row['kategori'] . "'>" . $row['kategori'] . "</option>";
                      }
                      echo $options;
                      ?>
                    </select> <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group has-error">
                  <div class="row">
                    <div class="col-6">
                      <label class="col">Kontak</label>
                      <div class="col">
                        <input name="kontak" placeholder="Kontak Amenitas" class="form-control" type="text" required>
                        <span class="help-block"></span>
                      </div>
                    </div>
                    <div class="col-6">
                      <label class="col">Maps</label>
                      <div class="col">
                        <input name="maps" placeholder="URL Google Maps Amenitas" class="form-control" type="text" required>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->