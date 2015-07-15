<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    public function clean($string) {
        $string = strip_tags($string);
        $string = stripcslashes($string);
        $string = htmlspecialchars($string);
        //  $p = new CHtmlPurifier();
        // $string = $p->purify($string);
        $string = addslashes($string);
        $string = str_replace("\r\n", "\n", $string);
        return $string;
    }

    public function index() {
        $students = Student::all();
        return view('student/index', array('students' => $students));
    }

    public function addStudent(Request $request) {
        // $request = new Request;
        $name = $this->clean($request->input('student-name'));
        $code = $this->clean($request->input('student-code'));
        $address = $this->clean($request->input('student-address'));
        $dob = $this->clean($request->input('student-dob'));
        $genderInp = $this->clean($request->input('male'));
        if (isset($genderInp)) {
            $gender = "Nam";
        } else {
            $gender = "Nữ";
        }
        if ($name != "" && $code != "" && $address != "" && $dob != "") {
            $student = new Student;
            $student->name = $name;
            $student->student_code = $code;
            $student->dob = $dob;
            $student->gender = $gender;
            $student->address = $address;

            $student->save();
            return Redirect::to(url('student'))->with('message', 'Tác vụ thành công !');
        }
        return view('student/add');
    }

    public function edit(Request $request) {
        $id = $this->clean($request->input('id'));
        $name = $this->clean($request->input('student-name'));
        $code = $this->clean($request->input('student-code'));
        $address = $this->clean($request->input('student-address'));
        $dob = $this->clean($request->input('student-dob'));
        $genderInp = $this->clean($request->input('male'));
        $type = $this->clean($request->input('type'));
        if (isset($genderInp)) {
            $gender = "Nam";
        } else {
            $gender = "Nữ";
        }
        if ($type == "edit") {
            if ($name != "" && $code != "" && $address != "" && $dob != "" && $id != "") {
                $student = Student::find($id);
                $student->name = $name;
                $student->student_code = $code;
                $student->dob = $dob;
                $student->gender = $gender;
                $student->address = $address;

                $student->save();
                return Redirect::back()->with('message', 'Tác vụ thành công !');
            }
        } else {
            $student = Student::find($id);
            $student->delete();
            return Redirect::to(url('student'))->with('message', 'Tác vụ thành công !');
        }
    }

    public function editStudent(Request $request) {
        $id = $this->clean($request->input('id'));
        $student = Student::find($id);
        return view('student/delete_edit', array('student' => $student));
    }

}
