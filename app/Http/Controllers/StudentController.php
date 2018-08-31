<?php

namespace App\Http\Controllers;

use App\MyClass;
use App\Academic;
use App\Program;
use App\Lavel;
use App\Shift;
use App\Time;
use App\Batch;
use App\Group;
use App\Student;

use Illuminate\Http\Request;

use Auth;
use DB;

class StudentController extends Controller
{
    public function allStudent(Request $request)
    {
      if($request->has('search')){

        $students = Student::where('id', 'like', '%' . (int)$request->search . '%')
                           ->orWhere('first_name', 'like', '%' . $request->search .'%')
                           ->orWhere('last_name', 'like', '%' . $request->search . '%')
                           ->paginate(10);

      }else{
        $students = Student::latest()->paginate(10);
      }

      return view('students.students', compact('students'));
    }


    public function createStudent()
    {
      $academics  = Academic::all();
      $programs   = Program::all();
      $lavels     = Lavel::all();
      $shifts     = Shift::all();
      $times      = Time::all();
      $batches    = Batch::all();
      $groups     = Group::all();

      return view('students.registration', compact('academics','programs','lavels','shifts','times','batches','groups') );
    }

    public function showStudent(Request $request){
      $studentid = $request->studentid;
      $student = Student::find($studentid);
      $courses = $this->studentCourse($studentid);

      if ($request->ajax()) {
        return response()->json([
          'student' => $student,
          'courses' => $courses
        ]);
      }
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


    public function storeStudent(Request $request)
    {
      $student = new Student();
      $student->first_name = $request->first_name;
      $student->last_name = $request->last_name;
      $student->sex = $request->sex;
      $student->dob = $request->dob;
      $student->email = $request->email;
      $student->status = $request->status;
      $student->nationality = $request->nationality;
      $student->national_id = $request->national_id;
      $student->passport = $request->passport;
      $student->phone = $request->phone;
      $student->village = $request->village;
      $student->commune = $request->commune;
      $student->district = $request->district;
      $student->city = $request->city;
      $student->current_address = $request->current_address;
      $student->dateregistered = $request->dateregistered;

      if($request->hasFile('photo')){
        $image = $request->file('photo');
        $filename = 'student-'.time().'.'.$image->getClientOriginalExtension();
        $request->photo->move(public_path('images'), $filename);
        $student->photo = $filename;
      }
      else{
        $filename = 'administrator.png';
        $student->photo = $filename;
      }
      $student->user_id = Auth::id();
      $student->save();
      $student->courses()->attach($request->courses_id);
      return back();
    }


    public function updateStudent(Request $request)
    {
      $student = Student::find($request->studentid); 

      if($request->hasFile('photo')){
        $image = $request->file('photo');
        $filename = 'student-'.time().'.'.$image->getClientOriginalExtension();
        $request->photo->move(public_path('images'), $filename);
        $request->photo = $filename;
      }
      else{
        $request->photo = $student->photo;
      }

      $updated = $student->update($request->all());
      $student->courses()->sync($request->courses_id);

      if ($request->ajax()) {
        return response()->json( [ 'message' => $updated ] );
      }
    }


    public function deleteStudent(Request $request){
      $student = Student::find($request->student_id);
      $deleted = $student->delete();
      $student->courses()->detach();

      if($student->photo != 'administrator.png'){
        unlink(public_path() .  '/images/' . $student->photo );
      }

      if($request->ajax()){
        return response()->json( [ 'message' => $deleted ] );
      }
    }



    // POPUP COURSES TABLE =====================================================

    public function showCourseInfo(Request $request)
    {
      $classes = $this->ClassInfo()->all();
      return view('students.course-table', compact('classes'));
    }

    public function ClassInfo()
    {
      return MyClass::join('academics','academics.academic_id', '=', 'classes.academic_id')
                    ->join('lavels','lavels.lavel_id', '=', 'classes.lavel_id')
                    ->join('programs','programs.program_id', '=', 'lavels.program_id')
                    ->join('shifts','shifts.shift_id', '=', 'classes.shift_id')
                    ->join('times','times.time_id', '=', 'classes.time_id')
                    ->join('groups','groups.group_id', '=', 'classes.group_id')
                    ->join('batches','batches.batch_id', '=', 'classes.batch_id')
                    ->get();
    }
}
