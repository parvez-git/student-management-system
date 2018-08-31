<div class="modal fade" id="level-show" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create Level</h4>
      </div>
      <div class="form-horizontal">
        <div class="modal-body">
            <select class="form-control" name="program_id" id="level-program-id">
              <option> --SELECT-- </option>
            </select> <br>
            <input type="text" name="lavel" id="new-level" class="form-control" placeholder="Lavel Name"> <br>
            <textarea name="description" id="new-level-description" class="form-control" placeholder="Level Description"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="level-save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
