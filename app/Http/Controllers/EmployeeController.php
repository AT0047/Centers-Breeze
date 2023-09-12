<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index(){
        $employees = Employee::orderBy('created_at', 'desc')->paginate(10);
        // $employees = User::where('type', 'instractor')->paginate(10);
        // $employees = User::where('type', 'instractor')->employee()->get();
        // $employees =  Employee::with('user')->where('type', 'instractor')->paginate(10);
        // $insta = User::whereHas('type', function ($subquery){
        //     $subquery->where('name', 'instractor');
        // })->get();
        return view('employees.index', compact('employees','insta'));
    } 
    
    public function create(){
        return view('employees.create');
    }

    public function store(Request $request){
        $request->validate([
            'job_title' => 'required|string',
            'salary' => 'required|numeric',
            'hire_date' => 'required|date',
        ]);
        $employee = new Employee();
        $employee->job_title = $request->job_title;
        $employee->salary = $request->salary;
        $employee->hire_date = $request->hire_date;
        $employee->save();
        return redirect()->route('employees.index')->with(['added',__('translate.Add New Employee')]);
    }

    public function edit($id){
        $employee = Employee::findorFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'job_title' => 'required|string',
            'salary' => 'required|numeric',
            'hire_date' => 'required|date',
        ]);
        $employee = Employee::findOrFail($id);
        $employee->job_title = $request->job_title;
        $employee->salary = $request->salary;
        $employee->hire_date = $request->hire_date;
        $employee->save();
        return redirect()->route('employees.index')->with(['added', __('translate.Employee updated')]);
    }

    public function destroy($id){
        try {
            Employee::destroy($id);
            return redirect()->route('employees.index')->with('added', __('translate.Employee Deleted'));
        } catch (Exception  $e) {
            Log::info($e->getMessage());
            return redirect()->route('employees.index');
        }
    }
}
