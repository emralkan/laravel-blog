<?php

namespace App\Http\Controllers\Back;
use Illuminate\Support\Str;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts=Post::orderBy('created_at', 'ASC')->get();

        return view('back.articles.index' , compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('back.articles.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $post=new Post;
        $post->title=$request->title;
        $post->category_id=$request->category;
        $post->content=$request->conntent;
        $post->slug = str::slug($request->title);

        if ($request->hasFile('image')){
            $imageName=str::slug($request->title). '.' .$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $post->image='uploads/'. $imageName;
        }
        $post->save();
        toastr()
            ->success(  'Başarılı', 'Makale Oluşturuldu !');

        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $makale=Post::findOrFail($id);
        $categories=Category::all();
        return view('back.articles.update' , compact('categories' , 'makale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:100'
        ]);

        $post=Post::findOrFail($id);
        $post->title=$request->title;
        $post->category_id=$request->category;
        $post->content=$request->conntent;
        $post->slug = str::slug($request->title);

        if ($request->hasFile('image')){
            $imageName=str::slug($request->title). '.' .$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $post->image='uploads/'. $imageName;
        }
        $post->save();
        toastr()
            ->success(  'Başarılı', 'Makale Güncellendi !');

        return redirect()->route('admin.makaleler.index');
    }
    public function switch(Request $request){
        $article=Post::findOrFail($request->id);
        $article->status=$request->statu=="true" ? 1 : 0 ;
        $article->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id){
    Post::find($id)->delete();
    toastr()->success('Geri Dönüşüm Kutusuna Taşındı');
    return redirect()->route('admin.makaleler.index');
    }

    public function hardDelete($id){
        $post= Post::onlyTrashed()->find($id)->forceDelete();
        if (File::exists($post->image)){
            File::delete(public_path($post->image));
        }
        toastr()->success('Silme İşlemi Başarılı');
        return redirect()->route('admin.makaleler.index');
    }

    public function trashed()
    {
        $posts=Post::onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
        return view('back.articles.trashed', compact('posts'));
    }

    public function recover($id){
        Post::onlyTrashed()->find($id)->restore();
        toastr()->success('Kurtarma İşlemi Başarılı');
        return redirect()->back();
    }

    public function destroy($id)
    {

    }
}
