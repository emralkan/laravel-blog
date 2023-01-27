@extends('front.layouts.master')
@section('title', 'blog sitesi')
@section('content')
<div class="col-md-10 col-lg-8 col-xl-7">
    @foreach($data['post'] as $post)
            <div class="post-preview">
                <a href="{{route('post', $post->slug)}}">
                    <h2 class="post-title">{{$post->title}}</h2>
                    <h3 class="post-subtitle">{{$post->content}}</h3>
                </a>
                <p class="post-meta">
                    <a href="#!">Yayın Tarihi</a>
                    {{$post->created_at}}
                    <br>
                    <a href="#!">Yazı Türü</a>
                    {{$post->getCategory->name}}
                </p>
            </div>

@if(!$loop->last)
            <hr class="my-4" />
        @endif
@endforeach
{{$data['post']->links('vendor.pagination.custom')}}            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
        </div>
@include('front.widgets.widget')
@endsection
