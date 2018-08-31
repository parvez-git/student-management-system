<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('dashboard') }}">Student MS</a>
        </div>
      </div>
      <div class="col-sm-9 col-md-10">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i>Dashboard</a></li>

            <li class="dropdown hidden-lg hidden-md hidden-sm">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fa fa-book"></i>Course <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('manage.course') }}"><i class="fa fa-angle-right"></i> Create</a></li>
                <li><a href="{{ route('course.student') }}"><i class="fa fa-angle-right"></i> Student</a></li>
              </ul>
            </li>
            <li class="dropdown hidden-lg hidden-md hidden-sm">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fa fa-users"></i>Students <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('student.index') }}"><i class="fa fa-angle-right"></i> All Student</a></li>
                <li><a href="{{ route('student.create') }}"><i class="fa fa-angle-right"></i> Registration</a></li>
                <li><a href="{{ route('fees.add') }}"><i class="fa fa-angle-right"></i> Fees</a></li>
              </ul>
            </li>
            <li class="dropdown hidden-lg hidden-md hidden-sm">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fa fa-dollar"></i>Fees <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('fees.course.add') }}"><i class="fa fa-angle-right"></i> Course Fee</a></li>
                <li><a href="{{ route('fees.add') }}"><i class="fa fa-angle-right"></i> Student Fee</a></li>
              </ul>
            </li>
            <li class="hidden-lg hidden-md hidden-sm"><a href="{{ route('settings.general') }}"><i class="fa fa-cogs"></i>Settings</a></li>

            <li><a href="#"><i class="fa fa-question-circle"></i>Help</a></li>
            @if (!Auth::guest())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      <i class="fa fa-user"></i>{{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('profile.index') }}"><i class="fa fa-user"></i> Profile</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
          </ul>
          <form class="navbar-form">
            <input type="text" class="form-control" placeholder="Search Something Special...">
          </form>
        </div>
      </div>
    </div>
  </div>
</nav>
