<div class="table-responsive table-container" id="student-course-table-data">

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
    <tbody>

      @foreach($classes as $class)
      <tr data-courseid="{{$class->class_id}}" title="+">
        <td>{{ $class->academic }}</td>
        <td>{{ $class->program }}</td>
        <td>{{ $class->lavel }}</td>
        <td>{{ $class->shift }}</td>
        <td>{{ $class->time }}</td>
        <td>{{ $class->group }}</td>
        <td>{{ $class->batch }}</td>
        <td>{{ $class->start_date }}</td>
        <td>{{ $class->end_date }}</td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div> <!-- END TABLE-CONTAINER -->
