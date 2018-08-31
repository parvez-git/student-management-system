<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt</title>
    <link href="{{ asset('fonts/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <style media="screen">
      h5 span {font-weight: bold;}
      .toplogoarea{margin-bottom:1px;background-color:white;margin-top:15px;padding:30px;}
      .signature{ margin-top: 150px;}
    </style>
  </head>

  <body>
    <div class="container">
      <div class="row">
        <button type="button" class="btn btn-info pull-right" id="print" name="button"><i class="fa fa-print"></i> Print</button>
      </div>

      <div id="receipt-div">

        <div class="row toplogoarea">
          <div class="col-md-6">
            <img src="{{ asset('images/school-logo.png')}}" alt="logo" width="200px"/>
          </div>
          <div class="col-md-6">
            <h5>Name: <span id="receipt-name"></span></h5>
            <h5>Phone: <span id="receipt-phone"></span></h5>
            <h5>Roll: <span id="receipt-roll"></span></h5>
            <h5>Email: <span id="receipt-email"></span></h5>
            <h5>Address: <span id="receipt-address"></span></h5>
          </div>
        </div>
        <div class="row">
          <div class="table-responsive table-container">

            <table class="table table-striped table-bordered" id="print-receipt-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date</th>
                  <th>Program</th>
                  <th>Amount</th>
                  <th>Discount</th>
                  <th>Paid</th>
                  <th>(% in $)</th>
                  <th>Total Paid</th>
                  <th>Cashier</th>
                  <th>Remark</th>
                </tr>
              </thead>
              <tbody id="receipt-tbody"></tbody>
            </table>

            <div class="row" style="margin-top:-10px">
              <div class="col-md-6 pull-right">
                <table class="table table-striped table-bordered">
                  <tbody id="receipt-sum-tbody"></tbody>
                </table>
              </div>
              <div class="col-md-6 pull-left">
                <div class="signature">
                  <span>-----------------------</span> <br>
                  <span>(Signature)</span>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('js/vendor/jquery.min.js') }}"><\/script>')</script>

    <script type="text/javascript">
      $(function(){

        var id = "{{ $studentid }}";
        $.get("{{route('fees.show')}}",{student_id: id}, function(data){

          if (data.student != null) {
            $('#receipt-name').text(data.student.first_name + ' ' + data.student.last_name);
            $('#receipt-roll').text(data.student.id);
            $('#receipt-phone').text(data.student.phone);
            $('#receipt-email').text(data.student.email);
            $('#receipt-address').text(data.student.current_address);
          }

          if (typeof data.receipt !== 'undefined' && data.receipt.length > 0) {
            receiptTable('#receipt-tbody', data.receipt, data.totalcourseamount);
            mergeCommonRows($('#print-receipt-table'));
          }

        });


      // -----------------------------------------------------------------------------
          $( document ).ready(function() {
            $('#print').on('click', function(e){
              printDiv('receipt-div');
            });
          });
          function printDiv(divName) {
             var printContents = document.getElementById(divName).innerHTML;
             var originalContents = document.body.innerHTML;

             document.body.innerHTML = printContents;

             window.print();

             document.body.innerHTML = originalContents;
           }
      // -----------------------------------------------------------------------------


        function receiptTable(tbodyid,receipt,totalcourseamount){
          var paidtotal = 0;
          var balance = 0;
          var balancetotal = 0;
          var discountamount = 0;
          var discounttotal = 0;
          for(var i=0; i<receipt.length; i++){
            discountamount = parseInt(receipt[i].amount - (receipt[i].amount * ( (100 - receipt[i].discount) / 100 )));
            discounttotal += parseInt(receipt[i].amount - (receipt[i].amount * ( (100 - receipt[i].discount) / 100 )));
            balance = parseInt(receipt[i].paid + discountamount);
            balancetotal += parseInt(receipt[i].paid + discountamount);
            paidtotal += parseInt(receipt[i].paid);
            var eachrow = '<tr>'
                        + "<td>" + receipt[i].fee_id + "</td>"
                        + "<td>" + receipt[i].transaction_date + "</td>"
                        + "<td>" + receipt[i].program + ' (' + receipt[i].lavel + ')' + "</td>"
                        + "<td>" + receipt[i].amount + "</td>"
                        + "<td>" + receipt[i].discount + "%</td>"
                        + "<td>" + receipt[i].paid + "</td>"
                        + "<td>" + discountamount + "</td>"
                        + "<td>" + balance + "</td>"
                        + "<td>" + receipt[i].username + "</td>"
                        + "<td>" + receipt[i].remark + "</td>"
                        + "</tr>";
            $(tbodyid).append(eachrow);
          }
          var tfootrow = '<tr>'
                      + '<th scope="row"> Subtotal: </th>'
                      + '<th scope="row">$' + totalcourseamount + '</th>'
                      + '</tr>'
                      + '<tr>'
                      + '<th scope="row"> Total Paid: </th>'
                      + '<th scope="row">$' + paidtotal + '</th>'
                      + '</tr>'
                      + '<tr>'
                      + '<th scope="row"> Total Discount: </th>'
                      + '<th scope="row">' + discounttotal + '%</th>'
                      + '</tr>'
                      + '<tr>'
                      + '<th scope="row"> Total: </th>'
                      + '<th scope="row">$' + balancetotal + '</th>'
                      + '</tr>'
                      + '<tr>'
                      + '<th scope="row"> Due: </th>'
                      + '<th scope="row">$' + (totalcourseamount - balancetotal) + '</th>'
                      + '</tr>';
          $('#receipt-sum-tbody').append(tfootrow);
        }



        function mergeCommonRows(table){
          var firstColumnBreaks = [];
          $.each(table.find('th'),function(i){
            var previous = null, cellToExtend = null, rowspan = 1;
            table.find("td:nth-child(" + i + ")").each(function(index,e){
              var jthis = $(this), content = jthis.text();
              if (previous == content && content !== "" && $.inArray(index, firstColumnBreaks) === -1) {
                jthis.addClass('hidden');
                cellToExtend.attr("rowspan", (rowspan = rowspan+1));
              }else{
                if(i===1) firstColumnBreaks.push(index);
                rowspan = 1;
                previous = content;
                cellToExtend = jthis;
              }
            });
          });
          $('to.hidden').remove();
        }

      });

    </script>

  </body>
</html>
