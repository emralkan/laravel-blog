<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use File;



class PageController extends Controller
{
    public function index(){
        $pages=Page::all();
        return view('back.pages.index', compact('pages'));
    }
    
    public function orders(Request $request){
        foreach($request->get('page') as $key => $order){
            Page::where('id' , $order)->update(['order'=> $key]);

        };
    }

    public function create(){
        return view('back.pages.create');
    }

    public function update($id){
        $page=Page::findOrFail($id);
        return view('back.pages.update', compact('page'));
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:100'
        ]);

        $page=Page::findOrFail($id);
        $page->title=$request->title;
        $page->content=$request->conntent;
        $page->slug = str::slug($request->title);

        if ($request->hasFile('image')){
            $imageName=str::slug($request->title). '.' .$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'. $imageName;
        }
        $page->save();
        toastr()
            ->success(  'Başarılı', 'Sayfa Güncellendi !');

        return redirect()->route('admin.page.index');
    }

    public function post(Request $request){
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $last=Page::orderBy('order', 'desc')->first();

        $page=new page;
        $page->title=$request->title;
        $page->content=$request->conntent;
        $page->order=$last->order+1;
        $page->slug = Str::slug($request->title);

        if ($request->hasFile('image')){
            $imageName=Str::slug($request->title). '.' .$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'. $imageName;
        }
        $page->save();
        toastr()->success( 'Başarılı', 'Sayfa Başarıyla Oluşturuldu !');

        return redirect()->route('admin.page.index');
    }

    public function pageDelete($id){
        $page=Page::find($id);
        if(File::exists($page->image)){
           File::delete(public_path($page->image));
        }
        $page->delete();
        toastr()->success('Sayfa Başarıyla Silindi');
        return redirect()->route('admin.page.index');
    }

    public function switch(Request $request){
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=="true" ? 1 : 0 ;
        $page->save();
    }
}
