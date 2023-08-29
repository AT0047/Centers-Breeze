<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('category_id')->paginate(10);
        return view('categories.index', compact('categories'));
    } 
    
    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->image = $request->file('image')->store('cateimgs');
        $category->category_id = $request->category_id;
        $category->save();
        return redirect()->route('categories.index')->with(['added','New Category Added']);
    }

    public function edit($id){
        $category = Category::findorFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        if($request->image && $category->image) Storage::disk('public')->delete($category->image);
        if($request->image) $category->image = $request->file('image')->store('cateimgs');
        $category->category_id = $request->category_id;
        $category->save();
        return redirect()->route('categories.index')->with(['added','New Category Updated']);
    }

    public function destroy($id){
        try{
            $category = Category::find($id);
            if(Storage::delete($category->image)){
                $category->delete();
            }
            return redirect()->route('categories.index')->with(['added' => 'Category Deleted Successfully']);
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->route('categories.index')->with(['added', $e->getMessage()]);
        }
    }
}
