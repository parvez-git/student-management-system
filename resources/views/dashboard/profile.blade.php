@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  <div class="form-container">

    <form id="profile-settings" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label for="school_name" class="col-sm-3 control-label">Name :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" id="school_name" value="{{ Auth::user()->name }}" required>
            </div>
          </div>
          <div class="form-group">
            <label for="username" class="col-sm-3 control-label">Username :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="username" id="username" value="{{ Auth::user()->username }}" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" required>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
            <div class="mb30">
              <img id="school-logo" src="{{asset('images/school-logo.png')}}" alt="" width="100%"/>
              <!-- <input type="file" name="logo" id="school-logo-upload" value="Upload" style="display:none"> -->
              <!-- <button type="button" id="school-logo-btn" class="btn"><i class="fa fa-upload"></i>&nbsp; UPLOAD</button> -->
            </div>
            </div>
          </div>
        </div>

      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default submitbtn"><i class="fa fa-arrow-circle-up"></i>&nbsp; UPDATE</button>
        </div>
      </div>

    </form>

  </div>

@endsection

@section('script')
  <script type="text/javascript">

    $(function(){
      $('#school-logo-btn').on('click', function(){
        $('#school-logo-upload').click();
      });
    });

  </script>
@endsection
