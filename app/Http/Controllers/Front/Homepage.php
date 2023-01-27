<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Page;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class Homepage extends Controller
{
    public function __construct(){
     view()->share('pages', Page::orderBy('order', 'ASC')->get());
    }
    public function index(){
        $data['post']=Post::orderBy('created_at', 'DESC')->paginate(2);
        $data['categories']=Category::inRandomOrder()->get();
        $data['image']=Post::whereId('')->first();
        return view('front.index', compact('data'));
    }

    public function posts($slug){
        $data['post']=Post::whereSlug($slug)->first();
        $data['categories']=Category::inRandomOrder()->get();
        $data['category']=Category::inRandomOrder()->get();
        $data['pages']=post::inRandomOrder()->get();
        return view('Front.posts', compact('data'));
    }
    public function category($slug){
        $category=Category::whereSlug($slug)->first();
        $data['categories']=Category::inRandomOrder()->get();
        $data['category']=$category;
        $data['post']=Post::where('category_id', $category->id)->get();
        return view('Front.category' , compact('data'));
    }
    public function page($slug){
        $page=Page::whereSlug($slug)->first();
        $data['page']=$page;
        return view('front.page' , compact('data'));
    }

    public function contact(){
        return view('front.contact');
    }
    public function contactpost(Request $request){
        $rules=[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];
        $validate=Validator::make($request->post(),$rules);

        if ($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }
        $contact = new Contact();
    $contact->name=$request->name;
    $contact->email=$request->email;
    $contact->topic=$request->topic;
    $contact->message=$request->message;
    $contact->save();
    return redirect('contact')->with('success' , 'Mesajınız İletildi!');
    }


}
