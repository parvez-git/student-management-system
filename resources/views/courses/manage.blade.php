@extends('layouts.master')

@section('title', 'courses')

@section('style')
  <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
@endsection

@section('content')

@include('courses.popup.academic')
@include('courses.popup.program')
@include('courses.popup.level')
@include('courses.popup.shift')
@include('courses.popup.time')
@include('courses.popup.batch')
@include('courses.popup.group')

<h2 class="page-header">Manage Course</h2>

<div class="form-container">

  <form id="form-course" action="{{ route('course.store') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <input type="hidden" name="active" value="1">
    <input type="hidden" name="class_id" id="class_id">

    <div class="form-group">
      <label for="academic_id" class="col-sm-2 control-label">Academic Year:</label>
      <div class="col-sm-10">
        <div class="input-group">
          <select class="form-control" name="academic_id" id="academic_id">
            <option> --Select-- </option>
            @foreach($academics as $academic)
            <option value="{{ $academic->academic_id }}">{{ $academic->academic }}</option>
            @endforeach
          </select>
          <div class="input-group-addon plus">
            <span data-toggle="modal" data-target="#academic-year-show"><i class="fa fa-plus"></i></span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="program_id" class="col-sm-2 control-label">Program:</label>
      <div class="col-sm-10">
        <div class="input-group">
          <select class="form-control" name="program_id" id="program_id">
            <option> --Select-- </option>
            @foreach($programs as $program)
            <option value="{{ $program->program_id}}">{{ $program->program }}</option>
            @endforeach
          </select>
          <div class="input-group-addon plus">
            <span data-toggle="modal" data-target="#program-show"><i class="fa fa-plus"></i></span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="lavel_id" class="col-sm-2 control-label">Level:</label>
      <div class="col-sm-10">
        <div class="input-group">
          <select class="form-control" name="lavel_id" id="lavel_id">
            <option> --Select-- </option>
            @foreach($lavels as $lavel)
            <option value="{{ $lavel->lavel_id}}">{{ $lavel->lavel }}</option>
            @endforeach
          </select>
          <div class="input-group-addon plus" id="lavel-program-show">
            <span data-toggle="modal" data-target="#level-show"><i class="fa fa-plus"></i></span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="shift_id" class="col-sm-2 control-label">Shift:</label>
      <div class="col-sm-10">
        <div class="input-group">
          <select class="form-control" name="shift_id" id="shift_id">
            <option> --Select-- </option>
            @foreach($shifts as $shift)
            <option value="{{ $shift->shift_id }}">{{ $shift->shift }}</option>
            @endforeach
          </select>
          <div class="input-group-addon plus">
            <span data-toggle="modal" data-target="#shift-show"><i class="fa fa-plus"></i></span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="time_id" class="col-sm-2 control-label">Time:</label>
      <div class="col-sm-10">
        <div class="input-group">
          <select class="form-control" name="time_id" id="time_id">
            <option> --Select-- </option>
            @foreach($times as $time)
            <option value="{{ $time->time_id }}">{{ $time->time }}</option>
            @endforeach
          </select>
          <div class="input-group-addon plus">
            <span data-toggle="modal" data-target="#time-show"><i class="fa fa-plus"></i></span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="batch_id" class="col-sm-2 control-label">Batch:</label>
      <div class="col-sm-10">
        <div class="input-group">
          <select class="form-control" name="batch_id" id="batch_id">
            <option> --Select-- </option>
            @foreach($batches as $batch)
            <option value="{{ $batch->batch_id }}">{{ $batch->batch }}</option>
            @endforeach
          </select>
          <div class="input-group-addon plus">
            <span data-toggle="modal" data-target="#batch-show"><i class="fa fa-plus"></i></span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="group_id" class="col-sm-2 control-label">Group:</label>
      <div class="col-sm-10">
        <div class="input-group">
          <select class="form-control" name="group_id" id="group_id">
            <option> --Select-- </option>
            @foreach($groups as $group)
            <option value="{{ $group->group_id }}">{{ $group->group }}</option>
            @endforeach
          </select>
          <div class="input-group-addon plus">
            <span data-toggle="modal" data-target="#group-show"><i class="fa fa-plus"></i></span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="start_date" class="col-sm-2 control-label">Start Date</label>
      <div class="col-sm-10">
        <div class="input-group">
          <div class="input-group-addon iconfirst"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control" name="start_date" id="start_date">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="end_date" class="col-sm-2 control-label">End Date</label>
      <div class="col-sm-10">
        <div class="input-group">
          <div class="input-group-addon iconfirst"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control" name="end_date" id="end_date">
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default submitbtn">Create Course</button>
      </div>
    </div>

  </form>

</div>

<div class="course-container">
  <div class="courses" id="add-class-info"></div>
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

    $("#start_date").datepicker({
      changeMonth: true,
      dateFormat: 'yy-mm-dd'
    });
    $( "#end_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });

    // --------------- ACADEMIC YEAR ------------------
    $('#academic-year-save').on('click', function(){
      var academic = $('#new-academic').val();
      $.post("{{ route('course.academic') }}",{ academic:academic }, function(data){
        $('#academic_id').append($("<option/>", {
          value: data.academic_id,
          text: data.academic
        }));
        $('#new-academic').val('');
      });
    });

    // --------------- PROGRAM ------------------
    $('#program-save').on('click', function(){
      var program = $('#new-program').val();
      var description = $('#new-program-description').val();
      $.post("{{ route('course.program') }}", {program:program,description:description}, function(data){
          $('#program_id').append($("<option/>",{
            value: data.program_id,
            text: data.program
          }));
          $('#new-program').val('');
          $('#new-program-description').val('');
        }
      );
    });

    $('#program_id').on('change', function(e){
      e.preventDefault();
      $('#lavel_id').empty();
      var program_id = $(this).val();
      $.get("{{ route('course.levelget') }}", { program_id:program_id }, function(data){
        $.each(data,function(i,leve){
          $('#lavel_id').append($("<option/>",{
            value: leve.lavel_id,
            text: leve.lavel
          }));
        })
      })
    });

    $('#lavel-program-show').on('click', function(){
      $('#level-program-id').empty();
      $.get("{{ route('course.programget') }}", function(data){
        $.each(data,function(i,pro){
          $('#level-program-id').append($("<option/>",{
            value: pro.program_id,
            text: pro.program
          }));
        })
      })
    });


    // --------------- LEVEL ------------------
    $('#lavel_id').empty();
    $('#level-save').on('click', function(){
      var programid = $('#level-program-id').val();
      var lavel = $('#new-level').val();
      var description = $('#new-level-description').val();
      $.post(
        "{{ route('course.level') }}",
        { program_id:programid, lavel:lavel, description:description },
        function(data){
          $('#lavel_id').append($("<option/>",{
            value: data.lavel_id,
            text: data.lavel
          }));
        }
      );
      $('#new-level').val('');
      $('#new-level-description').val('');
    });

    // --------------- SHIFT ------------------
    $('#shift-save').on('click', function(){
      var shift = $('#new-shift').val();
      $.post("{{ route('course.shift') }}",{shift:shift}, function(data){
        $('#shift_id').append($("<option/>",{
          value: data.shift_id,
          text: data.shift
        }))
      });
      $('#new-shift').val('');
    });

    // --------------- TIME ------------------
    $('#time-save').on('click', function(){
      var time = $('#new-time').val();
      $.post("{{ route('course.time') }}",{time:time}, function(data){
        $('#time_id').append($("<option/>",{
          value: data.time_id,
          text: data.time
        }))
      });
      $('#new-time').val('');
    });

    // --------------- BATCH ------------------
    $('#batch-save').on('click', function(){
      var batch = $('#new-batch').val();
      $.post("{{ route('course.batch') }}",{batch:batch}, function(data){
        $('#batch_id').append($("<option/>",{
          value: data.batch_id,
          text: data.batch
        }))
      });
      $('#new-batch').val('');
    });

    // --------------- GROUP ------------------
    $('#group-save').on('click', function(){
      var group = $('#new-group').val();
      $.post("{{ route('course.group') }}",{group:group}, function(data){
        $('#group_id').append($("<option/>",{
          value: data.group_id,
          text: data.group
        }))
      });
      $('#new-group').val('');
    });

    // =============== MyClass ===================
    showClassInformation($('#academic_id').val());

    $('#form-course').on('submit', function(e){
      e.preventDefault();
      var data = $(this).serialize();
      $.post("{{route('course.store')}}", data, function(data){
        showClassInformation(data.academic_id);
      })
      $(this).trigger('reset');
    });

    // --------------- EDIT COUSER -------------
    $(document).on('click','#edit-course-btn',function(e){
      e.preventDefault();
      var class_id = $(this).val();
      $.get("{{ route('course.edit') }}",{class_id:class_id},function(data){
        $('#academic_id').val(data.academic_id);
        $('#shift_id').val(data.shift_id);
        $('#time_id').val(data.time_id);
        $('#group_id').val(data.group_id);
        $('#batch_id').val(data.batch_id);
        $('#start_date').val(data.start_date);
        $('#end_date').val(data.end_date);

        $('#class_id').val(data.class_id);
        $('#form-course .submitbtn').addClass('update-course-btn');
        $('#form-course .submitbtn').text('Update Course');
      })
    })

    // --------------- UPDATE COUSER -------------
    $(document).on('click', '.update-course-btn', function(e){
      e.preventDefault();
      var data = $('#form-course').serialize();
      $.post("{{route('course.update')}}", data, function(data){
        showClassInformation(data.academic_id);

        $('#class_id').val('');
        $('#form-course .submitbtn').removeClass('update-course-btn');
        $('#form-course .submitbtn').text('Create Course');
        $('#form-course').trigger('reset');
      })
    });

    // --------------- DELETE COUSER -------------
    $(document).on('click','#del-course-btn',function(e){
      e.preventDefault();
      var class_id = $(this).val();
      $.post("{{ route('course.delete') }}",{class_id:class_id},function(data){
        showClassInformation($('#academic_id').val());
      })
    })

    // ------------- TABLE MERGE AND SHOW-----------------

    function showClassInformation(academic_id)
    {
      $.get("{{ route('course.index') }}", {academic_id:academic_id}, function(data){
        $('#add-class-info').empty().append(data);
        mergeCommonRows($('#table-data-info'));
      })
    }

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
