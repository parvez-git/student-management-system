<div class="modal fade" id="create-student-fee" tabindex="-1" role="dialog">
  <div class="modal-dialog modallg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Student Fees</h4>
      </div>
      <div class="form-horizontal">
        <form id="student-fee-form" action="" method="post">

          <input type="hidden" name="fee_id" id="feeid" value="">
          <input type="hidden" name="student_id" id="feestudentid" value="">
          <input type="hidden" name="level_id" id="feelevelid" value="">

          <div class="modal-body">
            <div class="form-group">
              <label for="fee" class="col-sm-3 control-label">Fee ($)</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="fee" id="fee">
              </div>
            </div>
            <div class="form-group">
              <label for="amount" class="col-sm-3 control-label">Amount ($)</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="amount" id="amount">
              </div>
            </div>
            <div class="form-group">
              <label for="discount" class="col-sm-3 control-label">Discount (%)</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="discount" id="discount">
              </div>
            </div>
            <div class="form-group">
              <label for="paid" class="col-sm-3 control-label">Paid ($)</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="paid" id="paid">
              </div>
            </div>
            <div class="form-group">
              <label for="lack" class="col-sm-3 control-label">Lack ($)</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="" id="lack">
              </div>
            </div>
            <div class="form-group">
              <label for="remark" class="col-sm-3 control-label">Remark</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="remark" id="remark" required>
              </div>
            </div>
            <div class="form-group">
              <label for="description" class="col-sm-3 control-label">Description</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="description" id="description" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label"></label>
              <div class="col-sm-9">
                <button type="submit" class="btn btn-default pull-right submitbtn">Add Fee</button>
              </div>
            </div>

          </div>
          <div class="modal-footer"></div> <!-- /.modal-footer -->
        </form>
      </div>

      <div class="table-responsive table-container">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Date</th>
              <th>($)</th>
              <th>(%)</th>
              <th width="100px">Paid + (%)</th>
              <th>(+/-)</th>
              <th>Remark</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody id="transaction-tbody"></tbody>
        </table>
      </div> <!-- /.table-container -->

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
