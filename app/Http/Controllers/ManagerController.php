<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManagerController extends Controller
{
    public function index(){
        $managers = Manager::orderBy('created_at', 'desc')->paginate(10);
        return view('managers.index', compact('managers'));
    } 
    
    public function create(){
        return view('managers.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|numeric',
        ]);
        $manager = new Manager();
        $manager->name = $request->name;
        $manager->mobile = $request->mobile;
        $manager->company_id = $request->company_id;
        $manager->save();
        return redirect()->route('managers.index')->with(['added','New Manager Added']);
    }

    public function edit($id){
        $manager = Manager::findorFail($id);
        return view('managers.edit', compact('manager'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
        ]);
        $manager = Manager::findOrFail($id);
        $manager->name = $request->name;
        $manager->mobile = $request->mobile;
        $manager->company_id = $request->company_id;
        $manager->save();
        return redirect()->route('managers.index')->with(['added','New Manager Updated']);
    }

    public function destroy($id){
        try {
            Manager::destroy($id);
            return redirect()->route('managers.index')->with('added', 'Manager Deleted');
        } catch (Exception  $e) {
            Log::info($e->getMessage());
            return redirect()->route('managers.index');
        }
    }

}
