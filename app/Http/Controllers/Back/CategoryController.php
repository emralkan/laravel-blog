<?php

namespace App\Http\Controllers\Back;
use Illuminate\Support\Str;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories=Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function switch(Request $request)
    {
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=="true" ? 1 : 0 ;
        $category->save();
    }

    public function create(Request $request)
    {
        $category= new Category;
        $category->name=$request->category;
        $category->slug= str::slug($request->category);
        toastr()->success('Başarılı', 'Kategori Ekleme İşlemi Başarılı');
        return redirect()->back();
    }
}
