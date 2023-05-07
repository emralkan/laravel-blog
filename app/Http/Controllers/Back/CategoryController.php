<?php

namespace App\Http\Controllers\Back;
use Illuminate\Support\Str;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

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
        $isExist= Category::whereSlug(str::slug($request->category))->first();
        if ($isExist){
            toastr()->error($request->category. ' adında bir kategori bulunuyor.', 'Hata');
            return redirect()->back();
        }
        $category= new Category;
        $category->name=$request->category;
        $category->slug= str::slug($request->category);
        $category->save();
        toastr()->success('Başarılı', 'Kategori Ekleme İşlemi Başarılı');
        return redirect()->back();
    }

    public function update(Request $request){
        $isName= Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        $isSlug= Category::whereSlug(str::slug($request->category))->whereNotIn('id',[$request->id])->first();
        if ($isSlug or $isName){
            toastr()->error($request->category. ' adında bir kategori bulunuyor.', 'Hata');
            return redirect()->back();
        }
        $category= Category::find($request->id);
        $category->name=$request->category;
        $category->slug= str::slug($request->slug);
        $category->save();
        toastr()->success('Başarılı', 'Kategori Düzenleme İşlemi Başarılı');
        return redirect()->route('admin.category.index');
    }

    public function delete(Request $request){
        $category=Category::findOrFail($request->id);
        if($category->id==21){
            toastr()->error('Hata', 'Bu kategori Silinemez');
            return redirect()->back();
        }
        $count=$category->postCount();
        if($count>0){
            Post::where('category_id',$category->id)->update(['category_id'=>21]);
        }
        $category->delete();
        toastr()->success('Başarılı', 'Kategori Başarıyla Silindi.' );
        return redirect()->back();
    }

    public function getData(Request $request){
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }
}
