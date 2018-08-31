<div class="modal fade" id="student-show-details" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Student Information</h4>
      </div>
      <div class="form-horizontal">
        <div class="modal-body">

          <div class="container">
            <div class="row">
              <div class="col-md-2">
                <img id="stud-img" src="" alt="" class="img-responsive" />
              </div>
              <div class="col-md-9" id="stud-info">
                <h3 id="full-name"></h3>
                <div class="row">
                  <div class="col-md-2">Email: </div>
                  <div class="col-md-10"><strong id="email"></strong></div>

                  <div class="col-md-2">Phone: </div>
                  <div class="col-md-10"><strong id="phone"></strong></div>

                  <div class="col-md-2">Current Address: </div>
                  <div class="col-md-10"><span id="current_address"></span></div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <div class="table-responsive table-container">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Academic</th>
                  <th>Program</th>
                  <th>Level</th>
                  <th>Shift</th>
                  <th>Time</th>
                  <th>Group</th>
                  <th>Batch</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                </tr>
              </thead>
              <tbody id="tbody"></tbody>
            </table>
          </div> <!-- END TABLE-CONTAINER -->
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
