<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class StudentsController extends Controller
{
    function studentindex(){

        $data = array('students' => DB::table('students',)->orderBy('created_at','desc')->paginate(10));

        return view('studenttable', ['students' => $data]);
    }

    function createstudent(){
        return view('students.create');
    }

function createstudentpost(Request $request){
    $request->validate([
        'name' => 'required',
        'age' => 'required',
        'adress' => 'required',
        'course' => 'required',
        'subject' => 'required',
    ]); 

    $data['name'] = $request->name;
    $data['age'] = $request->age;
    $data['adress'] = $request->adress;
    $data['course'] = $request->course;
    $data['subject'] = $request->subject;
    
    Students::create($data);

    return redirect(route('login'))->with("success", "New Student was added successfully!");
    }

    function show($id){
        $data = Students::findOrFail($id);
        return view('students.edit', ['student' => $data]);
    }

    function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'adress' => 'required',
            'course' => 'required',
            'subject' => 'required',
        ]); 
    
        $data['name'] = $request->name;
        $data['age'] = $request->age;
        $data['adress'] = $request->adress;
        $data['course'] = $request->course;
        $data['subject'] = $request->subject;
        
        $student = Students::findOrFail($id);
       $student->update($data);
    
        return back()->with('success', 'Data was successfully updated');
    }

    function destroy($id){
        $student = Students::findOrFail($id);
        $student->delete();
        return redirect('students-list')->with('success', 'Data was successfully deleted.');
    }
}
