<div class="col-sm-3 col-md-2 sidebar">

  <div class="nav-sidebar">
    <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i>Dashboard</a>
  </div>

  <ul class="nav nav-sidebar">
    <li><i class="fa fa-book"></i>Course</li>
    <li><a href="{{ route('manage.course') }}">Create</a></li>
    <li><a href="{{ route('course.student') }}">Student</a></li>
  </ul>

  <ul class="nav nav-sidebar">
    <li><i class="fa fa-users"></i>Students</li>
    <li><a href="{{ route('student.index') }}">All Student</a></li>
    <li><a href="{{ route('student.create') }}">Registration</a></li>
    <li><a href="{{ route('fees.add') }}">Fees</a></li>
  </ul>

  <ul class="nav nav-sidebar">
    <li><i class="fa fa-dollar"></i>Fees</li>
    <li><a href="{{ route('fees.course.add') }}">Course Fee</a></li>
    <li><a href="{{ route('fees.add') }}">Student Fee</a></li>
  </ul>

  <div class="nav-sidebar">
    <a href="{{ route('settings.general') }}"><i class="fa fa-cogs"></i>Settings</a>
  </div>

</div>
