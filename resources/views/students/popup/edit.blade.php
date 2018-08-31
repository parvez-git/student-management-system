<div class="modal fade" id="student-edit-details" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Student Information</h4>
      </div>
      <div class="form-horizontal">
        <form id="form-student-update" action="" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="studentid" id="editstudentid" value="">
        <div class="modal-body">
          <div class="formcontainer">
            <div class="row">
              <div class="col-md-6">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name">
              </div>
              <div class="col-md-6">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="email">Email</label>
                <div class="input-group">
                  <div class="input-group-addon iconfirst"><i class="fa fa-at"></i></div>
                  <input type="email" class="form-control" name="email" id="email">
                </div>
              </div>
              <div class="col-md-6">
                <label for="email">Date of Birth</label>
                <div class="input-group">
                  <div class="input-group-addon iconfirst"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control" name="dob" id="edit_dob_date" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="radiobtn">Sex</label>
                <label><input type="radio" name="sex" id="male" value="male"> Male </label>
                <label><input type="radio" name="sex" id="female" value="female"> Female </label>
              </div>
              <div class="col-md-6">
                <label class="radiobtn">Status</label>
                <label><input type="radio" name="status" id="single" value="single" checked> Single </label>
                <label><input type="radio" name="status" id="married" value="married"> Married </label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="nationality">Nationality</label>
                <input type="text" class="form-control" name="nationality" id="nationality">
              </div>
              <div class="col-md-6">
                <label for="national_id">National ID</label>
                <input type="number" class="form-control" name="national_id" id="national_id">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="passport">Passport</label>
                <input type="number" class="form-control" name="passport" id="passport">
              </div>
              <div class="col-md-6">
                <label for="phone">Phone</label>
                <input type="number" class="form-control" name="phone" id="phone">
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group-">
                  <label for="address">Village</label>
                  <input type="text" class="form-control" name="village" id="village">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group-">
                  <label for="commune">Commune</label>
                  <input type="text" class="form-control" name="commune" id="commune">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group-">
                  <label for="district">District</label>
                  <input type="text" class="form-control" name="district" id="district">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group-">
                  <label for="city">City</label>
                  <input type="text" class="form-control" name="city" id="city">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-9">
                <label for="current_address">Current Address</label>
                <textarea class="form-control" name="current_address" id="current_address" rows="8"></textarea>
              </div>
              <div class="col-md-3">
                <img src="" alt="" id="editphoto" class="img-responsive"/>
                <input type="file" name="photo" id="photo-file-btn" value="Upload" style="display:none;">
                <button type="button" id="edit-img-upload" class="btn" name="button">UPLOAD</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <div class="table-responsive table-container">
            <div class="row">
              <div class="col-md-9"><h3 class="text-left">Student's Courses</h3></div>
              <div class="col-md-3">
                <span class="btn btn-default addtopbtn" data-toggle="modal" data-target="#courses-popup"><i class="fa fa-plus"></i> Add Course</span>
              </div>
            </div>
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
              <tbody id="edit-tbody"></tbody>
            </table>

            <button type="submit" class="btn btn-default submitbtn">Update</button>

          </div> <!-- END TABLE-CONTAINER -->
        </div><!-- /.modal-footer -->

        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
