<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeachersController extends Controller
{
    function teachersindex(){

        $data = array('teachers' => DB::table('teachers',)->orderBy('created_at','desc')->paginate(10));
        
        return view('teacherstable', ['teachers' => $data]);
    }

    function createteacher(){
        return view('teachers.create');
    }

    function createteacherpost(Request $request){
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'adress' => 'required',
            'department' => 'required',
        ]); 
    
        $data['name'] = $request->name;
        $data['age'] = $request->age;
        $data['adress'] = $request->adress;
        $data['department'] = $request->department;
        
        Teachers::create($data);
    
        return redirect(route('login'))->with("success", "New teacher was added successfully!");
    }

    function show($id){
        $data = Teachers::findOrFail($id);
        return view('teachers.edit', ['teacher' => $data]);
    }

    function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'adress' => 'required',
            'department' => 'required',
        ]); 
    
        $data['name'] = $request->name;
        $data['age'] = $request->age;
        $data['adress'] = $request->adress;
        $data['department'] = $request->department;
        
        $teacher = Teachers::findOrFail($id);
       $teacher->update($data);
    
        return back()->with('success', 'Data was successfully updated');
    }

    function destroy($id){
        $teacher = Teachers::findOrFail($id);
        $teacher->delete();
        return redirect('/teachers-list')->with('success', 'Data was successfully deleted.');
    }
}
