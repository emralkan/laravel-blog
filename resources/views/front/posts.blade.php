@extends('front.layouts.master')
    @section('title', $data['post']->title)
@section('content')

            <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>{{($data['post'])->title}}</p>
                    <p>{{($data['post'])->conntent}}</p>
                <p class="post-meta">
                    <a href="#!">Yayın Tarihi</a>
                    {{($data['post'])->created_at}}
                    <br>
                    <a href="#!">Yazı Türü</a>
                    {{($data['post'])->getCategory->name}}
                </p>
             </div>

                @include('front.widgets.widget')
@endsection


