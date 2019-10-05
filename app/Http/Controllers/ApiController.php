<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class ApiController extends Controller
{
    //curl -X GET http://127.0.0.1:8000/api/students/show
    public function getAllStudents()
    {
    	$students = Student::get()->toJson(JSON_PRETTY_PRINT);
    	return response($students,200);
    }

    //curl -X POST -d "name=Adriana&course=Vue" http://127.0.0.1:8000/api/students/create
    public function createStudent(Request $request)
    {
    	//logic to create a student record goes here
    	$student = new Student;
    	$student->name = $request->name;
    	$student->course = $request->course;
    	$student->save();

    	return response()->json([
    		"message" => "student record created"
    	], 201);
    }

    //curl -X  GET -d "id" http://127.0.0.1:8000/api/students/get/1
    public function getStudent($id)
    {
    	//logic to get a student record goes here
    	if (Student::where('id', $id)->exists()) {
    		$student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
    		return response($student, 200);
    	} else{
    		return response()->json([
    			"message" => "student not found"
    		], 404);
    	}
    	
    }

    //curl -X PUT -d "id&name=Adriana Juarez Trejo&course=Angular"   http://127.0.0.1:8000/api/students/update/2
    public function updateStudent(Request $request, $id)
    {
    	//logic to update a studen record goes here
    	if (Student::where('id', $id)->exists()) {
    		$student = Student::find($id);
    		$student->name = is_null($request->name) ? $student->name : $request->name;
    		$student->course = is_null($request->course) ? $student->course : $request->course;
    		$student->save();

    		return response()->json([
    			"message" => "student record upadate"
    		],200); 
    	} else {
    		return response()->json([
    			"message" => "Student not found"
    		],404);
    	}
    }

    public function deleteStudent($id)
    {
    	//logic to delete a student record goes here
    	if (Student::where('id',$id)->exists()) {
    		$student = Student::find($id);
    		$student->delete();

    		return response()->json([
    			"message" => "Student deleted"
    		],202);
    	} else {
    		return response()->json([
    			"message" => "student not found"
    		],404);
    	}
    }
}
