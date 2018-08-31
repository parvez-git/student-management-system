@extends('layouts.master')

@section('title', 'Students')

@section('style')
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
@endsection

@section('content')

@include('students.popup.courses')
@include('students.popup.show')
@include('students.popup.edit')
@include('students.popup.delete')

<h2 class="page-header">
    All Student
    <a href="{{route('student.create')}}" class="pull-right btn btn-default addtopbtn"><i class="fa fa-plus"></i> Add Student</a>
</h2>

<div class="form-container">

  <div class="table-responsive table-container" id="stud-table-data-info">
    <div class="">

      <form id="search-form" class="pull-left" action="" method="GET">
        <input type="text" name="search" id="searchstudents" value="" placeholder="Search by ID, First or Last Name">
        <button type="submit" class="btn"><i class="fa fa-search"></i></button>
      </form>

      <div class="footer-pagination pull-right">
        {{ $students->links() }}
      </div>
    </div>

    <table class="table table-striped table-bordered" id="student-list-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Photo</th>
          <th>Name</th>
          <th>Email</th>
          <th>Sex</th>
          <th>Phone</th>
          <th>City</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach($students as $student)
        <tr>
          <th>{{ $student->id }}</th>
          <td>
              <img src="{{ asset('images/'.$student->photo) }}" class="img-circle" alt="{{ $student->first_name }}" width="40px"/>
          </td>
          <td>{{ $student->first_name }}</td>
          <td>{{ $student->email }}</td>
          <td>{{ $student->sex }}</td>
          <td>{{ $student->phone }}</td>
          <td>{{ $student->city }}</td>
          <td class="text-center">
            <button type="button" class="btn btn-primary btn-sm view" value="{{ $student->id }}"><i class="fa fa-eye"></i></button>
            <button type="button" class="btn btn-warning btn-sm edit" value="{{ $student->id }}"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm delete" value="{{ $student->id }}"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div> <!-- END TABLE-CONTAINER -->

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

    // SEARCH STUDENTS
    $(document).on('submit','#search-form', function(){
      var studentnameorid = $('#searchstudents').val();
      $.get('{{route('student.index')}}',{ search: studentnameorid }, function(data){
        console.log(data);
      });
    });

    // SHOW STUDENT DETAILS
    $('button.view').on('click', function(e){
      $('#student-show-details').modal('show');
      var studentid = $(this).val();
      $.get("{{route('student.show')}}",{studentid:studentid},function(data){
        $('#stud-img').attr('src','/images/'+data.student.photo);
        $('#stud-img').attr('alt',data.student.first_name);
        $('#stud-info #full-name').text(data.student.first_name+' '+data.student.last_name);
        $('#stud-info #email').text(data.student.email);
        $('#stud-info #phone').text(data.student.phone);
        $('#stud-info #current_address').text(data.student.current_address);
        courseTable('#tbody', data.courses);
      });
    });


    // EDIT STUDENT DETAILS
    $('button.edit').on('click', function(e){
      $('#student-edit-details').modal('show');
      var studentid = $(this).val();
      $.get("{{route('student.show')}}", { studentid: studentid }, function(data){
        $('#form-student-update #editstudentid').val(data.student.id);
        $('#form-student-update #first_name').val(data.student.first_name);
        $('#form-student-update #last_name').val(data.student.last_name);
        $('#form-student-update #email').val(data.student.email);
        $('#form-student-update #edit_dob_date').val(data.student.dob);
        $('#form-student-update #nationality').val(data.student.nationality);
        $('#form-student-update #national_id').val(data.student.national_id);
        $('#form-student-update #passport').val(data.student.passport);
        $('#form-student-update #phone').val(data.student.phone);
        $('#form-student-update #village').val(data.student.village);
        $('#form-student-update #commune').val(data.student.commune);
        $('#form-student-update #district').val(data.student.district);
        $('#form-student-update #city').val(data.student.city);
        $('#form-student-update #current_address').val(data.student.current_address);
        $('#form-student-update #editphoto').attr('src', '/images/'+data.student.photo);
        if(data.student.sex == 'female'){
          $('#form-student-update #female').attr('checked', true);
        }else{
          $('#form-student-update #male').attr('checked', true);
        }
        if(data.student.status == 'married'){
          $('#form-student-update #married').attr('checked', true);
        }else{
          $('#form-student-update #single').attr('checked', true);
        }
        courseTable('#edit-tbody', data.courses);
      });
    });

    // EDIT UPLOAD
    $(document).on('click','#edit-img-upload',function(e) {
      $('#photo-file-btn').click();
    });
    $('#photo-file-btn').on('change', function(){
      showImage(this, '#editphoto');
    });

    // REMOVE ADDED COURSE
    $(document).on('click', '#edit-tbody tr', function(e){
        $(this).remove();
    });

    // ADD POPUP COURSE
    $.get("{{ route('student.courses') }}", function(data){
      $('#student-courses-show').empty().append(data);
    });
    $(document).on('click', '#student-courses-show tbody tr', function(e){
      e.preventDefault();
      var courseid = $(this).data('courseid');
      var coursedata = $(this).html();
      $('#edit-tbody').append('<tr><input type="hidden" name="courses_id[]" value="'+courseid+'">'+coursedata+'</tr>');
      $('#courses-popup').modal('hide');
    });

    // UPDATE STUDENT
    $('#form-student-update').on('submit', function(e){
      e.preventDefault();
      var data = $(this).serialize();

      $.post("{{route('student.update')}}", data, function(data){
        if (data.message == true) {
          $('#student-edit-details').modal('hide');
          location.reload();
        }
      });
      // $(this).trigger('reset');
    });


    // DELETE STUDENT
    $('button.delete').on('click',function(e){
      e.preventDefault();
      $('#student-delete-details').modal('show');
      $('#student-delete-details #studentid').val($(this).val());
      $('#student-delete-details form').on('submit', function(e){
        // e.preventDefault();
        var studentid = $('#studentid').val();
        $.post("{{ route('student.delete') }}",{student_id:studentid},function(data){
          if(data.message == true){
            $('#student-delete-details').modal('hide');
            location.reload();
          }
        });
      });
    });


    // FUNCTION FOR TABLE DATA
    function courseTable(tbodyid,courses){
      $(tbodyid).empty();
      $.each(courses, function (index, item) {
           var eachrow = '<tr>'
                       + '<input type="hidden" name="courses_id[]" value="' + item.class_id + '">'
                       + "<td>" + item.academic + "</td>"
                       + "<td>" + item.program + "</td>"
                       + "<td>" + item.lavel + "</td>"
                       + "<td>" + item.shift + "</td>"
                       + "<td>" + item.time + "</td>"
                       + "<td>" + item.group + "</td>"
                       + "<td>" + item.batch + "</td>"
                       + "<td>" + item.start_date + "</td>"
                       + "<td>" + item.end_date + "</td>"
                       + "</tr>";
           $(tbodyid).append(eachrow);
      });
    }


    // DISPLAY UPLOADED IMAGE
    function showImage(fileInput,imageID){
      if (fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
          $(imageID).attr('src',e.target.result);
          $(imageID).attr('alt',fileInput.files[0].name);
        }
        reader.readAsDataURL(fileInput.files[0]);
      }
    }


  </script>
@endsection
