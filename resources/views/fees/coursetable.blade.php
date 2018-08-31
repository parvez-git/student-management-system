<div class="table-responsive table-container" id="course-table-data">
  <h3 class="heading-responsive">
    All Course
    <a href="{{route('fees.add')}}" class="btn btn-default btn-sm addtopbtn pull-right"><i class="fa fa-plus-circle"></i> Add Student Fee</a>
  </h3>
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
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach($courses as $course)
      <tr>
        <td>{{ $course->academic }}</td>
        <td>{{ $course->program }}</td>
        <td>{{ $course->lavel }}</td>
        <td>{{ $course->shift }}</td>
        <td>{{ $course->time }}</td>
        <td>{{ $course->group }}</td>
        <td>{{ $course->batch }}</td>
        <td>{{ $course->start_date }}</td>
        <td>{{ $course->end_date }}</td>
        <td class="text-center">

          <button type="button" class="btn btn-warning btn-sm addcoursefeebtn"
            data-classid="{{ $course->class_id }}"
            data-academicid="{{ $course->academic_id }}"
            data-lavelid="{{ $course->lavel_id }}"> <i class="fa fa-dollar"></i>
          </button>

        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div> <!-- END TABLE-CONTAINER -->
