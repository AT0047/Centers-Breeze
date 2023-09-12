<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index(Request $request){
        $classrooms = ClassRoom::query();
        if($request->has('search')){
            $classrooms->where('name', 'like','%'.$request->search.'%');
        }
        return view('classrooms.index', [
            'classrooms' => $classrooms->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
