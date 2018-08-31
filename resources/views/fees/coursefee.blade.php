@extends('layouts.master')

@section('title', 'Course Fees')

@section('content')

@include('fees.popup.coursefee')

  <h2 class="page-header">Add Course Fee</h2>

  <div class="course-container">
    <div class="courses" id="add-class-fees"></div>
  </div>

@endsection

@section('script')
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
      $.get("{{ route('fees.course.list') }}", function(data){
        $('#add-class-fees').empty().append(data);
        mergeCommonRows($('#course-table-data'));
      });
    });

    $(document).on('click','button.addcoursefeebtn',function(e){
      e.preventDefault();
      $('#create-course-fee').modal('show');

      var class_id    = $(this).data('classid');
      var academic_id = $(this).data('academicid');
      var level_id    = $(this).data('lavelid');

      $('#classid').val(class_id);
      $('#academicid').val(academic_id);
      $('#levelid').val(level_id);
    });

    $(document).on('submit','#coursefeeform',function(e){
      e.preventDefault();

      var data = $(this).serialize();

      $.post("{{route('fees.course.store')}}", data, function(data){
        if(data.msg == 'ok'){
          $('#create-course-fee').modal('hide');
        }
      });
      $(this).trigger('reset');

    });



    function mergeCommonRows(table)
    {
      var firstColumnBreaks = [];
      $.each(table.find('th'),function(i){
        var previous = null, cellToExtend = null, rowspan = 1;
        table.find("td:nth-child(" + i + ")").each(function(index,e){
          var jthis = $(this), content = jthis.text();
          if (previous == content && content !== "" && $.inArray(index, firstColumnBreaks) === -1) {
            jthis.addClass('hidden');
            cellToExtend.attr("rowspan", (rowspan = rowspan+1));
          }else{
            if(i===1) firstColumnBreaks.push(index);
            rowspan = 1;
            previous = content;
            cellToExtend = jthis;
          }
        });
      });
      $('to.hidden').remove();
    }

  </script>
@endsection
