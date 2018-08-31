@extends('layouts.master')

@section('title', 'Registration')

@section('style')
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
@endsection

@section('content')

@include('students.popup.courses')

<h2 class="page-header">
    Student Registration
    <a href="{{route('student.index')}}" class="pull-right btn btn-default addtopbtn"><i class="fa fa-group"></i> All Student</a>
</h2>

<div class="form-container">

  <form id="form-student-reg" action="{{ route('student.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="first_name" class="col-sm-2 control-label">First Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
      </div>
    </div>

    <div class="form-group">
      <label for="last_name" class="col-sm-2 control-label">Last Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
      </div>
    </div>

    <div class="form-group">
      <label for="email" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email Adderess">
      </div>
    </div>

    <div class="form-group">
      <label for="sex" class="col-sm-2 control-label">Sex</label>
      <div class="col-sm-10">
        <div class="radio">
          <label><input type="radio" name="sex" id="sex" value="male" checked> Male </label>
          <label><input type="radio" name="sex" id="sex" value="female"> Female </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="status" class="col-sm-2 control-label">Status</label>
      <div class="col-sm-10">
        <div class="radio">
          <label><input type="radio" name="status" id="status" value="single" checked> Single </label>
          <label><input type="radio" name="status" value="married"> Married </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="dob_date" class="col-sm-2 control-label">Date of Birth</label>
      <div class="col-sm-10">
        <div class="input-group">
          <div class="input-group-addon iconfirst"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control" name="dob" id="dob_date" autocomplete="off">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="nationality" class="col-sm-2 control-label">Nationality</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nationality" id="nationality" placeholder="Nationality">
      </div>
    </div>

    <div class="form-group">
      <label for="national_id" class="col-sm-2 control-label">National ID</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="national_id" id="national_id" placeholder="National ID">
      </div>
    </div>

    <div class="form-group">
      <label for="passport" class="col-sm-2 control-label">Passport</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="passport" id="passport" placeholder="Passport Number">
      </div>
    </div>

    <div class="form-group">
      <label for="phone" class="col-sm-2 control-label">Phone</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone Number">
      </div>
    </div>

    <div class="form-group">
      <label for="address" class="col-sm-2 control-label">Address</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="village" id="address" placeholder="Village">
      </div>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="commune" id="commune" placeholder="Commune">
      </div>
    </div>
    <div class="form-group">
      <label for="address" class="col-sm-2 control-label"></label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="district" id="district" placeholder="District">
      </div>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="city" id="city" placeholder="City">
      </div>
    </div>

    <div class="form-group">
      <label for="current_address" class="col-sm-2 control-label">Current Address</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="current_address" rows="3"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="dateregistered" class="col-sm-2 control-label">Date of Register</label>
      <div class="col-sm-10">
        <div class="input-group">
          <div class="input-group-addon iconfirst"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control" name="dateregistered" id="dateregistered" autocomplete="off">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="" class="col-sm-2 control-label">Course</label>
      <div class="col-sm-10">
        <div id="student-course-btn">
          <span class="btn btn-default addtopbtn" data-toggle="modal" data-target="#courses-popup"><i class="fa fa-plus"></i> Add Course</span>
        </div>

        <table id="student-course-table" class="table table-bordered">
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
          <tbody id="student-course"></tbody>
        </table>
      </div>
    </div>

    <div class="form-group">
      <label for="photo" class="col-sm-2 control-label">Photo</label>
      <div class="col-sm-10">
      <div class="mb30">
        <img id="stud-img" src="{{asset('images/administrator.png')}}" alt="" class="imgbtnwidth"/>
        <input type="file" name="photo" id="register-student-img-upload" value="Upload" style="display:none;">
        <button type="button" id="register-student-img-btn" class="btn imgbtnwidth" name="button">UPLOAD</button>
      </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default pull-right submitbtn">Register</button>
      </div>
    </div>

  </form>

</div>

@endsection

@section('script')
  <script src="{{ asset('js/vendor/jquery-ui.js') }}"></script>
  <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( "#dob_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'yy-mm-dd'
    });
    $( "#dateregistered" ).datepicker({
      changeMonth: true,
      dateFormat: 'yy-mm-dd'
    });


    // DISPLAY UPLOADED IMAGE
    function showImage(fileInput){
      if (fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
          $('#stud-img').attr('src',e.target.result);
          $('#stud-img').attr('alt',fileInput.files[0].name);
        }
        reader.readAsDataURL(fileInput.files[0]);
      }
    }
    $(document).on('click','#register-student-img-btn',function(e) {
      $('#register-student-img-upload').click();
    });
    $('#register-student-img-upload').on('change', function(){
      showImage(this);
    });


    // DISPLAY COURSE
    $('#student-course-table').hide();
    $(document).on('click', '#student-courses-show tbody tr', function(e){
      e.preventDefault();
      var courseid = $(this).data('courseid');
      var coursedata = $(this).html();
      $('#student-course-table').show();
      $('#student-course').append('<tr><input type="hidden" name="courses_id[]" value="'+courseid+'">'+coursedata+'</tr>');
      $('#courses-popup').modal('hide');
    });


    // POPUP COURSE TABLE DATA

    showCourseInformation();

    function showCourseInformation()
    {
      $.get("{{ route('student.courses') }}" ,function(data){
        $('#student-courses-show').empty().append(data);
      })
    }


  </script>
@endsection
