
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Fee</th>
        <th>Date</th>
        <th>Paid</th>
        <th>Accountant</th>
      </tr>
    </thead>
    <tbody>

      @foreach($transactions as $transaction)
        <tr>
          <td>{{ $transaction->studentid }}</td>
          <td>{{ $transaction->full_name }}</td>
          <td>{{ $transaction->studentfee }}</td>
          <td>{{ date('Y-m-d', strtotime($transaction->transaction_date)) }}</td>
          <td>{{ $transaction->paid }}</td>
          <td>{{ $transaction->name }}</td>
        </tr>
      @endforeach

    </tbody>
  </table>

  <div class="">
    {{ $transactions->links() }}
  </div>
