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
        // $employees = Employee::orderBy('created_at', 'desc')->paginate(10);
        // $employees = User::where('type', 'instractor')->employee()->get();
        $employees =  Employee::orderBy('created_at', 'desc')->paginate(10);
        return view('employees.index', compact('employees'));
    } 
    
    public function create(){
        return view('Employees.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|numeric',
        ]);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->mobile = $request->mobile;
        $employee->company_id = $request->company_id;
        $employee->save();
        return redirect()->route('employees.index')->with(['added','New Employee Added']);
    }

    public function edit($id){
        $Employee = Employee::findorFail($id);
        return view('Employees.edit', compact('Employee'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
        ]);
        $employee = Employee::findOrFail($id);
        $employee->name = $request->name;
        $employee->mobile = $request->mobile;
        $employee->company_id = $request->company_id;
        $employee->save();
        return redirect()->route('employees.index')->with(['added','New Employee Updated']);
    }

    public function destroy($id){
        try {
            Employee::destroy($id);
            return redirect()->route('employees.index')->with('added', 'Employee Deleted');
        } catch (Exception  $e) {
            Log::info($e->getMessage());
            return redirect()->route('employees.index');
        }
    }
}
