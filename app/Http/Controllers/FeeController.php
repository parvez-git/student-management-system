<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyClass;
use App\Student;
use App\Receipt;
use App\Fee;
use App\FeeType;
use App\StudentFee;
use App\Transaction;
use App\ReceiptDetail;
use Auth;
use DB;

class FeeController extends Controller
{
    public function courseList()
    {
      $courses = MyClass::join('academics','academics.academic_id', '=', 'classes.academic_id')
                    ->join('lavels','lavels.lavel_id', '=', 'classes.lavel_id')
                    ->join('programs','programs.program_id', '=', 'lavels.program_id')
                    ->join('shifts','shifts.shift_id', '=', 'classes.shift_id')
                    ->join('times','times.time_id', '=', 'classes.time_id')
                    ->join('groups','groups.group_id', '=', 'classes.group_id')
                    ->join('batches','batches.batch_id', '=', 'classes.batch_id')
                    ->get();

      return view('fees.coursetable',compact('courses'));
    }

    public function addCourseFees()
    {
      return view('fees.coursefee');
    }

    public function storeCourseFees(Request $request)
    {
      $feetype = FeeType::create(['fee_type' => 'coursefee']);

      $input = $request->all();
      $input['fee_type_id'] = $feetype->id;
      $input['fee_heading'] = 'coursefee';

      Fee::updateOrCreate( ['class_id' => $request->class_id], $input );

      if($request->ajax()){
        return response()->json(['msg' => 'ok']);
      }
    }


    // COURSE FEES
    public function addFees()
    {
      $receiptno = Receipt::receiptNumber();
      return view('fees.payment',compact('receiptno'));
    }

    public function showFees(Request $request)
    {
      $id = $request->student_id;

      $student = Student::find($id);

      $courses = $this->studentCourse($id);

      $receipt = $this->receiptPrint($id);

      $totalcourseamount = StudentFee::where('student_id', $id)->distinct()->get(['fee_id','amount'])->SUM('amount');

      if($request->ajax()){
        return response()->json([
          'student' => $student,
          'courses' => $courses,
          'receipt' => $receipt,
          'totalcourseamount' => $totalcourseamount
        ]);
      }
    }


    public function storeFees(Request $request)
    {
      $studentfee = StudentFee::create([
        'fee_id'      => $request->fee_id,
        'student_id'  => $request->student_id,
        'level_id'    => $request->level_id,
        'amount'      => $request->fee,
        'discount'    => $request->discount
      ]);

      $transaction = Transaction::create([
        'fee_id'          => $request->fee_id,
        'user_id'         => Auth::id(),
        'student_id'      => $request->student_id,
        'paid'            => $request->paid,
        'remark'          => $request->remark,
        'description'     => $request->description,
        'transaction_date'=> date('Y-m-d H:i:s'),
        'student_fee_id'  => $studentfee->id
      ]);

      $receiptid = Receipt::receiptNumber();

      $receiptdetail = ReceiptDetail::create([
        'receipt_id'      => $receiptid,
        'student_id'      => $request->student_id,
        'transaction_id'  => $transaction->id
      ]);

      if($request->ajax()){
        return response()->json([
          'studentid' => $transaction['student_id'],
        ]);
      }
    }


    public function transactionDelete(Request $request)
    {
      $details = ReceiptDetail::where('transaction_id', $request->transaction_id)->delete();
      $transaction = Transaction::find($request->transaction_id);
      $student_fee = StudentFee::find($transaction->student_fee_id)->delete();
      $transaction->delete();
      if($request->ajax()){
        return response()->json(['msg' => 'deleted']);
      }
    }


    public function courseFees(Request $request)
    {
        $coursefee = Fee::where('class_id','=',$request->class_id)->first();

        $transaction = StudentFee::join('transactions','transactions.student_fee_id', '=', 'student_fees.id')
                                 ->where('transactions.fee_id', $coursefee['id'])
                                 ->where('transactions.student_id', $request->student_id)
                                 ->get();

       if($request->ajax()){
         return response()->json([
           'courseamount' => $coursefee,
           'transaction'  => $transaction,
         ]);
       }

    }


    private function receiptPrint($studentid)
    {
      return Transaction::join('student_fees', 'student_fees.id', '=', 'transactions.student_fee_id')
                        ->join('fees', 'fees.id', '=', 'transactions.fee_id')
                        ->join('lavels', 'lavels.lavel_id', '=', 'fees.level_id')
                        ->join('programs', 'programs.program_id', '=', 'lavels.program_id')
                        ->join('users', 'users.id', '=', 'transactions.user_id')
                        ->where('transactions.student_id', $studentid)
                        ->orderBy('transactions.fee_id')
                        ->get();
    }

    private function studentCourse($studentid)
    {
      return DB::table('class_student')
                ->join('students','students.id',            '=', 'class_student.student_id')
                ->join('classes','classes.class_id',        '=', 'class_student.class_id')
                ->join('academics','academics.academic_id', '=', 'classes.academic_id')
                ->join('lavels','lavels.lavel_id',          '=', 'classes.lavel_id')
                ->join('programs','programs.program_id',    '=', 'lavels.program_id')
                ->join('shifts','shifts.shift_id',          '=', 'classes.shift_id')
                ->join('times','times.time_id',             '=', 'classes.time_id')
                ->join('groups','groups.group_id',          '=', 'classes.group_id')
                ->join('batches','batches.batch_id',        '=', 'classes.batch_id')
                ->where('student_id', $studentid )
                ->get();

    }


    // PRINT RECEIPT
    public function printFeesReceipt($id)
    {
      return view('fees.receipt')->with('studentid', $id);
    }

}
