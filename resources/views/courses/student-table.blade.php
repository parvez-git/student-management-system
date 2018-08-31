<div class="table-responsive table-container" id="student-table-data">

  <table class="table table-striped table-bordered" id="student-table">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Sex</th>
        <th>Phone</th>
        <th>City</th>
        <th class="text-center">Roll</th>
      </tr>
    </thead>
    <tbody>

      @foreach($students as $student)
        <tr>
          <td>
              <img src="{{ asset('images/'.$student->photo) }}" class="img-circle" alt="{{ $student->first_name }}" width="40px"/>
          </td>
          <td>{{ $student->first_name }}</td>
          <td>{{ $student->email }}</td>
          <td>{{ $student->sex }}</td>
          <td>{{ $student->phone }}</td>
          <td>{{ $student->city }}</td>
          <td class="text-center">
            <button type="button" class="btn btn-default btn-sm">{{ $student->roll }}</button>
          </td>
        </tr>
      @endforeach

    </tbody>
  </table>
</div> <!-- END TABLE-CONTAINER -->
