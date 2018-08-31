<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\MyClass;
use App\Transaction;
use App\StudentFee;
use App\Fee;
use DB;

use App\Setting;


class DashboardController extends Controller
{
  public function __construct()
  {
    return $this->middleware('web');
  }


  public function dashboard()
  {
      $totalstudent = Student::count();
      $totalcourse = MyClass::count();
      $totaltransaction = Transaction::sum('paid');

      $studentfees = StudentFee::join('transactions','transactions.student_fee_id','=','student_fees.id')
                               ->join('fees','fees.id','=','student_fees.fee_id')
                               ->join('classes','classes.class_id','=','fees.class_id')
                               ->join('lavels','lavels.lavel_id','=','classes.lavel_id')
                               ->join('programs','programs.program_id','=','lavels.program_id')
                               ->select('program', DB::raw('SUM(transactions.paid) as total_paid, SUM(student_fees.discount) as total_discount, fees.amount, lavels.lavel'))
                               ->groupBy('fees.amount', 'program','lavels.lavel')
                               ->get();

      $studentlist = Student::latest()->take(9)->get();


      return view('dashboard.dashboard', compact('totalstudent','totalcourse','totaltransaction','studentfees','studentlist' ));
  }


  public function dashboardChart()
  {
    $student['male'] = Student::where('sex','=','male')->count();
    $student['female'] = Student::where('sex','=','female')->count();

    return response()->json([ 'student' => $student ]);
  }


  public function dashboardTransaction(Request $request)
  {
    if( $request->has('datefrom') && $request->has('dateto') ){

      $transactions = Transaction::join('fees','fees.id','=','transactions.fee_id')
                                ->join('students','students.id','=','transactions.student_id')
                                ->join('student_fees','student_fees.id','=','transactions.student_fee_id')
                                ->join('users','users.id','=','transactions.user_id')
                                ->select('users.name',
                                         'students.id as studentid',
                                         'fees.amount as schoolfee',
                                         'student_fees.amount as studentfee',
                                         'transaction_date',
                                         'paid',
                                          DB::raw('CONCAT(last_name, \' \', first_name) AS full_name')
                                        )
                                ->whereDate('transaction_date', '>=', $request->datefrom)
                                ->whereDate('transaction_date', '<=', $request->dateto)
                                ->paginate(4);
    }else {

      $transactions = Transaction::join('fees','fees.id','=','transactions.fee_id')
                                ->join('students','students.id','=','transactions.student_id')
                                ->join('student_fees','student_fees.id','=','transactions.student_fee_id')
                                ->join('users','users.id','=','transactions.user_id')
                                ->select('users.name',
                                         'students.id as studentid',
                                         'fees.amount as schoolfee',
                                         'student_fees.amount as studentfee',
                                         'transaction_date',
                                         'paid',
                                          DB::raw('CONCAT(last_name, \' \', first_name) AS full_name')
                                        )
                                ->paginate(4);


    }

    return view('dashboard.transactionfee-table', compact('transactions'));
  }


  /* ---------------------------------------------------------------------------
     GENERAL SETTINGS
  --------------------------------------------------------------------------- */
  public function settingsForm()
  {
    $settings = Setting::first();

    return view('dashboard.settings',compact('settings'));
  }

  public function settingsStore(Request $request)
  {
    if($request->hasFile('logo')){
      $logo = $request->file('logo');
      $filename = 'school-logo.'.$logo->getClientOriginalExtension();
      $request->logo->move(public_path('images'), $filename);
      $logoimage = $filename;
    }else{
      $logoimage = 'school-logo.png';
    }

    Setting::updateOrCreate(
      [ 'id'      => 1 ],
      [
        'name'    => $request->name,
        'address' => $request->address,
        'phone'   => $request->phone,
        'email'   => $request->email,
        'footer'  => $request->footer,
        'logo'    => $logoimage
      ]
    );

    return redirect()->route('settings.general');
  }

}
