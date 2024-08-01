    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Edit</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
              <input type="hidden" value="" name="id_fak" />
              <div class="form-body">
                <div class="form-group has-error">
                  <label class="col">Kategori</label>
                  <div class="col">
                    <input name="kategori" placeholder="Kategori" class="form-control" type="text" required>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group has-error">
                  <label class="col">Tipe Kategori</label>
                  <div class="col">
                    <select name="tipe" class="form-control" required>
                      <option value="dtw">DTW</option>
                      <option value="amenitas">Amenitas</option>
                    </select> <span class="help-block"></span>
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