<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Welcome Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders the "marketing page" for the application and
      | is configured to only allow guests. Like most of the other sample
      | controllers, you are free to modify or remove it as you desire.
      |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index() {
        $students = Student::all();
        return view('student/index', array('students' => $students));
    }

    public function addStudent(Request $request) {
        // $request = new Request;
        $name = $request->input('student-name');
        $code = $request->input('student-code');
        $address = $request->input('student-address');
        $dob = $request->input('student-dob');
        $gender_inp = $request->input('male');
        if (isset($gender_inp)) {
            $gender = "Nam";
        } else {
            $gender = "Nữ";
        }
        $student = new Student;
        $student->name = $name;
        $student->student_code = $code;
        $student->dob = $dob;
        $student->gender = $gender;
        $student->address = $address;

        $student->save();

        return view('student/add');
    }

    public function edit(Request $request) {
        $id = $request->input('student-id');
        $name = $request->input('student-name');
        $code = $request->input('student-code');
        $address = $request->input('student-address');
        $dob = $request->input('student-dob');
        $gender_inp = $request->input('male');
        if (isset($gender_inp)) {
            $gender = "Nam";
        } else {
            $gender = "Nữ";
        }

        $student = Student::find($id);
        $student->name = $name;
        $student->student_code = $code;
        $student->dob = $dob;
        $student->gender = $gender;
        $student->address = $address;

        $student->save();
    }

    public function editStudent(Request $request) {
        $id = $request->input('id');
        $student = Student::find($id);
        return view('student/delete_edit', array('student' => $student));
    }

}
