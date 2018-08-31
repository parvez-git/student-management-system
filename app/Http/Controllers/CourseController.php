<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Academic;
use App\Program;
use App\Lavel;
use App\Shift;
use App\Time;
use App\Batch;
use App\Group;
use App\MyClass;
use DB;

class CourseController extends Controller
{
    public function manageCourse()
    {
      $academics = Academic::all();
      $programs = Program::all();
      $lavels = Lavel::all();
      $shifts = Shift::all();
      $times = Time::all();
      $batches = Batch::all();
      $groups = Group::all();

      return view('courses.manage',compact('academics','programs','lavels','shifts','times','batches','groups'));
    }

    public function courseAcademic(Request $request)
    {
      if($request->ajax()){
        return response( Academic::create($request->all()) );
      }
    }

    public function courseProgram(Request $request)
    {
      if ($request->ajax()) {
        return response( Program::create($request->all()) );
      }
    }
    public function courseProgramOnLevel(Request $request)
    {
      if ($request->ajax()) {
        return response( Program::all() );
      }
    }

    public function courseGetLevel(Request $request)
    {
      if ($request->ajax()) {
        return response( Lavel::where('program_id',$request->program_id)->get() );
      }
    }

    public function courseLevel(Request $request)
    {
      if ($request->ajax()) {
        return response( Lavel::create($request->all()) );
      }
    }

    public function courseShift(Request $request)
    {
      if ($request->ajax()) {
        return response( Shift::create($request->all()) );
      }
    }

    public function courseTime(Request $request)
    {
      if ($request->ajax()) {
        return response( Time::create($request->all()) );
      }
    }

    public function courseBatch(Request $request)
    {
      if ($request->ajax()) {
        return response( Batch::create($request->all()) );
      }
    }

    public function courseGroup(Request $request)
    {
      if ($request->ajax()) {
        return response( Group::create($request->all()) );
      }
    }

    public function myClass(Request $request)
    {
      if ($request->ajax()) {
        return response(MyClass::create($request->all()));
      }
    }

    public function showClassInfo()
    {
      $classes = $this->ClassInfo()->all();
      return view('courses.course', compact('classes'));
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


    public function editCourse(Request $request)
    {
      if ($request->ajax()) {
        return response(MyClass::find($request->class_id));
      }
    }

    public function updateCourse(Request $request)
    {
      if ($request->ajax()) {
        return response(MyClass::updateOrCreate( ['class_id' => $request->class_id], $request->all() ));
      }
    }

    public function deleteCourse(Request $request)
    {
      if ($request->ajax()) {
        MyClass::destroy($request->class_id);
      }
    }


    // COURSE STUDENT
    public function courseStudentTable(Request $request)
    {
      if($request->has('course_id')){
        $students = DB::table('class_student')
                      ->join('students','students.id','=','class_student.student_id')
                      ->join('classes','classes.class_id','=','class_student.class_id')
                      ->select('students.first_name','students.email','students.sex','students.phone','students.city','students.id as roll','students.photo')
                      ->where('class_student.class_id',$request->course_id)
                      ->distinct()
                      ->get();
      }else{
        $students = DB::table('class_student')
                      ->join('students','students.id','=','class_student.student_id')
                      ->join('classes','classes.class_id','=','class_student.class_id')
                      ->select('students.first_name','students.email','students.sex','students.phone','students.city','students.id as roll','students.photo')
                      ->distinct()
                      ->get();
      }
      return view('courses.student-table',compact('students'));
    }


    public function courseStudent()
    {
      return view('courses.student');
    }
}
