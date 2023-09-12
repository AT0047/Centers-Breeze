<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index(){
        $classrooms = ClassRoom::orderBy('created_at', 'desc')->paginate(10);
        return view('classrooms.index', compact('classrooms'));

    }
}
