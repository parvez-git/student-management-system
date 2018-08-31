<div class="table-responsive table-container" id="table-data-info">
  <h3 class="heading-responsive">All Course</h3>
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
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach($classes as $class)
      <tr>
        <td>{{ $class->academic }}</td>
        <td>{{ $class->program }}</td>
        <td>{{ $class->lavel }}</td>
        <td>{{ $class->shift }}</td>
        <td>{{ $class->time }}</td>
        <td>{{ $class->group }}</td>
        <td>{{ $class->batch }}</td>
        <td>{{ $class->start_date }}</td>
        <td>{{ $class->end_date }}</td>
        <td>
          <button type="button" id="edit-course-btn" class="btn btn-primary btn-sm" value="{{ $class->class_id }}"><i class="fa fa-edit"></i></button>
          <button type="button" id="del-course-btn" class="btn btn-danger btn-sm" value="{{ $class->class_id }}"><i class="fa fa-trash"></i></button>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div> <!-- END TABLE-CONTAINER -->
