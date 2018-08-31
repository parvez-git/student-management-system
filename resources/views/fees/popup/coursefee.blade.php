<div class="modal fade" id="create-course-fee" tabindex="-1" role="dialog">
  <div class="modal-dialog modallg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add or Update Course Fees</h4>
      </div>
      <div class="form-horizontal">
        <form id="coursefeeform" action="" method="post">

          <input type="hidden" id="classid" name="class_id" value="">
          <input type="hidden" id="academicid" name="academic_id" value="">
          <input type="hidden" id="levelid" name="level_id" value="">

          <div class="modal-body">
            <div class="form-group">
              <label for="amount" class="col-sm-3 control-label">Amount ($)</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="amount" id="amount" required>
              </div>
            </div>
          </div> <!-- /.modal-body -->

          <div class="modal-footer">
            <div class="row">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-default pull-right submitbtn">Add Course Fee</button>
              </div>
            </div>
          </div> <!-- /.modal-footer -->

        </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
