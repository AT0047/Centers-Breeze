<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'type' => 'required|'
        ]);

        User::create($request->except('_token'));
        return redirect()->route('users.index')->with(['added' => 'New User Added']);
    }

    public function edit($id){
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'type' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->update($request->except('_token'));
        return redirect()->route('users.index')->with(['added' => 'User'. $request->name .'Added']);
        
    }

    public function destroy($id){
        try {
            User::destroy($id);
            return redirect()->route('users.index')->with('added', 'Employee Deleted');
        } catch (Exception  $e) {
            Log::info($e->getMessage());
            return redirect()->route('users.index');
        }
    }
}
