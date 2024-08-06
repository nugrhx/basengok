          <script type="text/javascript">
            function readURL(input) {
              if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                  $('#foto').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
              }
            }
          </script>

          <!-- Bootstrap modal -->
          <div class="modal fade" id="modal_form" role="dialog">
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
                          <input name="foto" type="file" accept="image/*" multiple="multiple" />
                          <span class="help-block"></span>
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