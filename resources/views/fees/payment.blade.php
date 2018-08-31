@extends('layouts.master')

@section('title', 'Fees')

@section('content')

@include('fees.popup.studentfee')
@include('fees.popup.redirect')

  <h2 class="page-header">Fees</h2>

  <div class="form-container" style="margin-bottom:1px">
    <div class="row">
      <div class="col-sm-4">
        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
              <label for="student_id" class="col-sm-4 control-label">Student ID</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" id="student_id" min="1">
              </div>
            </div>
        </form>
      </div>
      <div class="col-sm-3">
        <div class="form-horizontal form-group">
          <label class="control-label">Name: </label>
          <span id="full-name"></span>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-horizontal form-group">
          <label class="control-label">Date: </label>
          <span> @php echo date('Y-m-d'); @endphp </span>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-horizontal form-group">
          <label class="control-label">Receipt No: </label>
          <span>{{ sprintf('%05d',$receiptno) }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="table-responsive table-container">
    <table class="table table-striped table-bordered" id="payment-table">
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
          <th>Pay</th>
        </tr>
      </thead>
      <tbody id="fees-tbody"></tbody>
    </table>
  </div>

  <div class="table-responsive table-container" style="margin-top:15px">
    <h3 class="heading-responsive">
      Transaction List
      <a id="printlink" href="" class="btn btn-info addtopbtn pull-right" target="_blank"><i class="fa fa-print"></i> Print Receipt</a>
    </h3>
    <table class="table table-striped table-bordered" id="receipt-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Date</th>
          <th>Program</th>
          <th>Amount</th>
          <th>Discount</th>
          <th>Paid</th>
          <th>(% in $)</th>
          <th>Balance</th>
          <th>Cashier</th>
          <th>Remark</th>
        </tr>
      </thead>
      <tbody id="receipt-tbody"></tbody>
      <tfoot id="receipt-tfoot"></tfoot>
    </table>
  </div>

@endsection

@section('script')
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#printlink').css('display','none');

    $('#student_id').on('blur', function(){

      $('#fees-tbody').empty();
      $('#receipt-tbody').empty();
      $('#receipt-tfoot').empty();

      var id = $(this).val();

      $.get("{{route('fees.show')}}",{student_id: id}, function(data){

        if (data.student != null) {
          $('#full-name').text(data.student.first_name + ' ' + data.student.last_name);
        }else{
          $('#full-name').html('<span style="color:red">Student does not exist !</span>');
        }

        if (typeof data.courses !== 'undefined' && data.courses.length > 0) {
          courseTable('#fees-tbody',data.courses);
        }else{
          $('#fees-tbody').empty();
        }

        if (typeof data.receipt !== 'undefined' && data.receipt.length > 0) {
          receiptTable('#receipt-tbody', data.receipt, data.totalcourseamount);
          mergeCommonRows($('#receipt-table'));
        }else{
          $('#receipt-tbody').empty();
          $('#receipt-tfoot').empty();
        }

      });

      if(id){
        // var printurl = "{{route('fees.add')}}";
        var printurl = '/student/fees/receipt/'+id;
        $('#printlink').attr('href',printurl);
        $('#printlink').css('display','block');
      }else{
        $('#printlink').css('display','none');
      }

    });


    // ADD COURSE FEE FORM
    $(document).on('click','button.btnfees',function(){

      var classid   = $(this).data('classid');
      var studentid = $(this).data('studentid');
      var levelid   = $(this).data('levelid');

      $('#feestudentid').val(studentid);
      $('#feelevelid').val(levelid);

      $.get("{{route('fees.course')}}", { class_id: classid, student_id: studentid }, function(data){

        if (data.courseamount != null) {
          $('#create-student-fee').modal('show');
          $('#feeid').val(data.courseamount.id);
          $('#fee').val(data.courseamount.amount).attr('readonly',true);
        }else{
          $('#feeid').val('');
          $('#redirect-to-course-fee').modal('show');
        }

        if (typeof data.transaction !== 'undefined' && data.transaction.length > 0) {
          transactionTable('#transaction-tbody',data.transaction);
          var balance = 0;
          $.each(data.transaction,function(index, item) {
              balance += (item.paid + (item.amount - (item.amount * ( (100-item.discount) / 100 ))));
          });
          var unpaid = parseInt(data.courseamount.amount - balance);
          if(unpaid == 0){
            $('#student-fee-form').hide();
          }else{
            $('#student-fee-form').show();
          }
          $('#amount').val(data.courseamount.amount);
          $('#paid').val(unpaid);
          $('#discount').val(0);
          $('#lack').val(0);
        }else{
          $('#transaction-tbody').empty();
        }

      });

      $('#student-fee-form').trigger('reset');
    });

    $(document).on('submit','#student-fee-form',function(e){
      e.preventDefault();
      var data = $(this).serialize();
      $.post("{{route('fees.store')}}", data, function(data){

        // update receipt table on submit
        if (data.studentid) {
          var id = data.studentid;
          $('#receipt-tfoot').empty();
          $.get("{{route('fees.show')}}",{student_id: id}, function(data){
            receiptTable('#receipt-tbody', data.receipt, data.totalcourseamount);
            mergeCommonRows($('#receipt-table'));
          });
        }

      });
      $('#create-student-fee').modal('hide');
      $(this).trigger('reset');
    });

    $(document).on('click','button.btntransaction',function(e){
      e.preventDefault();
      var transactionid = $(this).data('transactionid');
      $.post("{{route('fees.transaction.delete')}}",{transaction_id:transactionid},function(data){
        if(data.msg == 'deleted'){
          $('tr#' + transactionid).remove();
        }
      })
    });



    // FUNCTION FOR TABLE DATA
    function courseTable(tbodyid,courses){
      $(tbodyid).empty();
      $.each(courses, function (index, item) {
           var eachrow = '<tr>'
                       + "<td>" + item.academic + "</td>"
                       + "<td>" + item.program + "</td>"
                       + "<td>" + item.lavel + "</td>"
                       + "<td>" + item.shift + "</td>"
                       + "<td>" + item.time + "</td>"
                       + "<td>" + item.group + "</td>"
                       + "<td>" + item.batch + "</td>"
                       + "<td>" + item.start_date + "</td>"
                       + "<td>" + item.end_date + "</td>"
                       + '<td>' + '<button type="button" class="btn btn-sm btn-warning btnfees" data-classid="' + item.class_id + '" data-studentid="' + item.student_id + '" data-levelid="' + item.lavel_id + '"> <i class="fa fa-usd"></i> </button>' + '</td>'
                       + "</tr>";
           $(tbodyid).append(eachrow);
      });
    }


    function transactionTable(tbodyid,transaction){
      $(tbodyid).empty();
      var discountamount = 0;
      var paidamount = 0;
      var balance = 0;
      for(var i=0; i<transaction.length; i++){
        discountamount = parseInt(transaction[i].amount - (transaction[i].amount * ( (100 - transaction[i].discount) / 100 )));
        paidamount += (transaction[i].paid + (transaction[i].amount - (transaction[i].amount * ( (100 - transaction[i].discount) / 100 ))));
        balance = parseInt(transaction[i].amount - paidamount);
        var eachrow = '<tr id="' + transaction[i].id + '">'
                    + "<td>" + transaction[i].transaction_date.split(" ", 1) + "</td>"
                    + "<td>" + transaction[i].amount + "</td>"
                    + "<td>" + transaction[i].discount + "%</td>"
                    + "<td>" + transaction[i].paid + " + " + discountamount + "</td>"
                    + "<td>" + balance + "</td>"
                    + "<td>" + transaction[i].remark + "</td>"
                    + '<td class="text-center">' + '<button type="button" class="btn btn-danger btn-sm btntransaction" data-transactionid="' + transaction[i].id + '"><i class="fa fa-trash"></i></button>'  + '</td>'
                    + "</tr>";
        $(tbodyid).append(eachrow);
      }
    }


    function receiptTable(tbodyid,receipt,totalcourseamount){
      $(tbodyid).empty();

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
                  + '<td colspan="3"></td>'
                  + '<th colspan="2" scope="row">' + totalcourseamount + '</th>'
                  + '<th scope="row">' + paidtotal + '</th>'
                  + '<th scope="row">' + discounttotal + '</th>'
                  + '<th scope="row">' + balancetotal + '</th>'
                  + '<th colspan="2"> Unpaid: ' + (totalcourseamount - balancetotal) + '</th>'
                  + '</tr>';
      $('#receipt-tfoot').append(tfootrow);
    }


    /* TABLE MERGE
    ==================================================== */
    function mergeCommonRows(table)
    {
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

    /* COURSE FEE CALCULATION
    ==================================================== */
    $(document).on('change keyup','#amount',function(e){
      e.preventDefault();

      var fee       = $('#fee').val();
      var amount    = $('#amount').val();
      var paid      = $('#paid').val($('#amount').val());
      var discount  = 0;
      // var lack    = 0;

      if( paid != '' && amount != ''){
        paid      = parseFloat($('#amount').val());
        discount  = ( ( (parseFloat(fee) - parseFloat(paid)) * 100) / fee );
        lack    = ( parseFloat(amount) - parseFloat(fee) );
        $('#lack').val(lack);
      }

      if( paid == '' && amount == ''){
        $('#paid').val();
        $('#discount').val();
      }

      if( parseFloat(amount) > parseFloat(fee) ){
        $('#discount').css('color','red');
      }else{
        $('#discount').css('color','black');
      }
      $('#discount').val(parseInt(discount));

    });

    $(document).on('change keyup','#discount',function(e){
      e.preventDefault();

      var fee       = parseFloat($('#fee').val());
      var discount  = 0;
          discount  = ( fee * parseFloat($(this).val()) / 100 );
      var amount    = ( fee - discount );

      $('#paid').val(parseInt(amount));
      // $('#amount').val(parseInt(amount));

    });

    $(document).on('change keyup','#paid',function(e){
      e.preventDefault();

      var balance = $('#amount').val();
      var pay     = $('#paid').val();

      if(pay == ''){
        $('#lack').val(0);
      }
      if(pay != ''){
        paid = parseFloat($('#paid').val());
      }
      if(pay != '' && balance != ''){
        var lack = parseFloat(balance) - parseFloat(paid);
        $('#lack').val(parseInt(lack));
      }
      if( $('#lack').val() < 0 ){
        $('#lack').css('color','red');
      }else{
        $('#lack').css('color','black');
      }

    });

  </script>
@endsection
