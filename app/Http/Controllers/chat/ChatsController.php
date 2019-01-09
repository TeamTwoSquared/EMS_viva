<?php

namespace App\Http\Controllers\chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chat;
class ChatsController extends Controller
{

    public function svp_index()
    {
        return view('svp.chat');
    }

    public function client_index()
    {
        return view('client.chat');
    }


    public function create()
    {
        //for student
        // return view('student.create');
    }

    public function store(Request $request)//take an input from as a var and store it in the db
    {

        $chat = new Chat();
        $chat->massege = $request->massege;
        $chat->save();
    }


    public function show($id)
    {
        $chat = Chat::find($id);
        return $chat;

    }


    public function edit($id)// go to page edit
    {
        //for student
        //$student = Student::find($id);
        //return view('student.edit')->with('student',$student);
    }


    public function update(Request $request, $id)
    {
        //for student
        //$student = Student::find($id);
        //$student->name = $request->name;
        //$student->age = $request->age;
        //$student->save();
    }


    public function destroy($id)
    {
        //$student = Student::find($id);
        //$student->delete();
    }
}