@extends('layouts.master')

@section('title', 'courses')

@section('content')

  @include('students.popup.courses')

  <h2 class="page-header">
    Course Student
    <button type="button" id="courses-popup-btn" class="btn btn-info pull-right"><i class="fa fa-folder"></i> Courses</button>
  </h2>

  <div class="form-container">
    <div id="student-list"></div>
  </div>


@endsection

@section('script')
  <script type="text/javascript">
    $(function(){

      courseStudent();

      function courseStudent(courseid) {
        $.get("{{route('course.student.list')}}", { course_id: courseid } ,function(data){
          $('#student-list').empty().append(data);
        });
      }

      // COURSE POPUP
      $.get("{{ route('student.courses') }}",function(data){
        $('#student-courses-show').empty().append(data);
      });

      $('#courses-popup-btn').on('click', function(){
        $('#courses-popup').modal('show');
      });

      $(document).on('click', '#student-courses-show tbody tr', function(e){
        e.preventDefault();
        var courseid = $(this).data('courseid');
        courseStudent(courseid)
        $('#courses-popup').modal('hide');
      });


    });

  </script>
@endsection
