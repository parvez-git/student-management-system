@extends('layouts.master')

@section('title', 'Home')

@section('style')
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
@endsection

@section('content')
  <h2 class="page-header">Dashboard</h2>

  <div class="row">
    <div class="col-sm-4">
      <div class="dash-box">
        <i class="fa fa-users fa-2x"></i>
        <h3>{{ $totalstudent }} <small>Students</small></h3>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="dash-box">
        <i class="fa fa-book fa-2x"></i>
        <h3>{{ $totalcourse }} <small>Courses</small></h3>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="dash-box">
        <i class="fa fa-usd fa-2x"></i>
        <h3>{{ $totaltransaction }} <small>USD</small></h3>
      </div>
    </div>
  </div>

  <div class="mt30">
    <div class="row">
      <div class="col-sm-4">
        <div class="p30 dash-box3 dash-box5">
          <h4 style="margin-top:0;">Registered Students</h4>
          @foreach($studentlist as $student)
            <div class="student-image">
              <img class="img-circle img-responsive" src="{{ asset('images/'.$student->photo) }}" alt="{{ $student->first_name }}" />
              <div class="student-info">
                <div class="text-center">
                  <img class="img-center img-responsive" src="{{ asset('images/'.$student->photo) }}" alt="{{ $student->first_name }}" />
                  Name: {{$student->first_name}} {{$student->last_name}} <br>
                  Roll No: {{$student->id}} <br>
                  Sex: {{$student->sex}} <br>
                  Date of Birth: {{$student->dob}} <br>
                  Email: {{$student->email}} <br>
                  Phone: {{$student->phone}} <br>
                  Nationality: {{$student->nationality}} <br>
                  National ID: {{$student->national_id}} <br>
                  Passport: {{$student->passport}} <br>
                  Village: {{$student->village}} <br>
                  District: {{$student->district}} <br>
                  City: {{$student->city}}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="col-sm-8">
        <div class="p30 dash-box3 dashboard-transaction">
          <h4>Fee Report
            <div class="pull-right dash-box5">
              <input type="text" name="datefrom" id="datefrom" value="" placeholder="From" required>
              <input type="text" name="dateto" id="dateto" value="" placeholder="To" required>
            </div>
          </h4>
          <div id="transactionfeelist" class="table-responsive"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="mt30">
    <div class="row">
      <div class="col-sm-8">
        <div class="dash-box2 dash-box3 dash-box5">
          <div id="barchart_transaction"></div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="dash-box3">
          <div id="malefemale_student"></div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('js/vendor/loader.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/vendor/jquery-ui.js') }}"></script>
  <script type="text/javascript">

    $( "#datefrom" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      onSelect: function(datefrom){
        showTransactionFee( datefrom, $('#dateto').val() );
      }
    });

    $( "#dateto" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      onSelect: function(dateto){
        showTransactionFee( $('#datefrom').val(), dateto );
      }
    });

    function showTransactionFee(datefrom, dateto){
      $.get("{{route('dashboard.transaction')}}", { datefrom:datefrom, dateto:dateto } ,function(data){
        $('#transactionfeelist').empty().html(data);
      });
    }
    showTransactionFee();


    // CHART JSON DATA
    var male    = 0;
    var female  = 0;
    $.get("{{route('dashboard.chart')}}", function(data){
      male    = data.student.male;
      female  = data.student.female;
    });


    google.charts.load('current', {'packages':['corechart','bar']});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawTransactionChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ['Male', male],
        ['Female', female]
      ]);

      var options = {'title':'Number of Male and Female student','height': 260};

      var chart = new google.visualization.PieChart(document.getElementById('malefemale_student'));
      chart.draw(data, options);
    }

    function drawTransactionChart() {

      var data = google.visualization.arrayToDataTable([
        ['Program','Amount','Paid','Discount'],
        @foreach($studentfees as $transaction)
          [
            '{{$transaction->program}}({{$transaction->lavel}})',
            {{$transaction->amount}},
            {{$transaction->total_paid}},
            {{$transaction->total_discount}}
          ],
        @endforeach
      ]);

      var options = {
        chart: {
          title: 'Transaction',
          subtitle: 'Paid amount for courses',
        },
        bars: 'horizontal',
      };

      var chart = new google.charts.Bar(document.getElementById('barchart_transaction'));
      chart.draw(data, google.charts.Bar.convertOptions(options));

    }

  </script>
@endsection
