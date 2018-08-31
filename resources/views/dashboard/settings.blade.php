@extends('layouts.master')

@section('title', 'Settings')

@section('content')
  <h2 class="page-header">General Settings</h2>

  <div class="form-container">

    <form id="general-settings" action="{{ route('settings.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label for="school_name" class="col-sm-3 control-label">School Name :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" id="school_name" value="{{ $settings->name or null }}" required>
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-sm-3 control-label">Address :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="address" id="address" value="{{ $settings->address or null }}" required>
            </div>
          </div>
          <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">Phone :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="phone" id="phone" value="{{ $settings->phone or null }}" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" name="email" id="email" value="{{ $settings->email or null }}" required>
            </div>
          </div>
          <div class="form-group">
            <label for="footer" class="col-sm-3 control-label">Footer :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="footer" id="footer" value="{{ $settings->footer or null }}" required>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <!-- <label for="photo" class="col-sm-2 control-label"></label> -->
            <div class="col-sm-offset-1 col-sm-10">
            <div class="mb30">
              @if(isset($settings->logo))
              <img id="school-logo" src='{{asset("images/$settings->logo")}}' alt="" width="100%"/>
              @else
              <img id="school-logo" src="{{asset('images/school-logo.png')}}" alt="" width="100%"/>
              @endif
              <input type="file" name="logo" id="school-logo-upload" value="Upload" style="display:none">
              <button type="button" id="school-logo-btn" class="btn"><i class="fa fa-upload"></i>&nbsp; UPLOAD</button>
            </div>
            </div>
          </div>
        </div>

      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default submitbtn"><i class="fa fa-save"></i>&nbsp; SAVE</button>
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
