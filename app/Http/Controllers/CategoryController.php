<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request){
        $search = $request->search;

        $categories = Category::when($search, function($query) use($search) {
            $query->where('category_name', 'like', '%' . $search . '%');
        })
        ->latest()
        ->get();

        return Inertia::render('Categories/CategoriesView', [
            'categories' => $categories,
            'search' => $search
        ]);
    }

    public function storeForm(){
        return Inertia::render('Categories/CreateCategoriesView');
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required',
            'image' => 'required'
        ]);

        $image = $request->image->store('categories', 'public');

        Category::create([
            'category_name' => ucwords($request->category_name),
            'image' => $image
        ]);

        return redirect()->route('categories');
    }

    public function delete(Category $category){
        $category->delete();

        Storage::disk('public')->delete($category->image);
    }

    public function updateForm(Category $category){
        return Inertia::render('Categories/UpdateCategoriesView', [
            'category' => $category
        ]);
    }

    public function update(Category $category, Request $request){
        $request->validate([
            'category_name' => 'required',
            'image' => 'required'
        ]);

        if($request->image == $category->image){
            $image = $request->image;
        }else{
            $image = $request->image->store('categories', 'public');
            Storage::disk('public')->delete($category->image);
        }

        $category->update([
            'category_name' => ucwords($request->category_name),
            'image' => $image
        ]);

        return redirect()->route('categories');
    }
}
