@extends('layouts.app')

@section('title', '404')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading" id="panel-heading">
                  <h2>404</h2>
                </div>
                <div class="panel-body" id="panel-body">
                    You are not permitted for this area!
                    <br><br>
                    <a class="btn btn-black" href="{{ route('dashboard') }}">Go Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
