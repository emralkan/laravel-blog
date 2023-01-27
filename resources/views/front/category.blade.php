@extends('front.layouts.master')
@section('title', $data['category']->slug)
@section('content')
<div class="col-md-10 col-lg-8 col-xl-7">
    @foreach($data['post'] as $post)
            <div class="post-preview" >
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
    @if(count($data['post'])==0)
    <div class="text-primary">
        <span class="text-primary">
            Kategoriye Ekleme Yapılmamış.
        </span>
    </div>
        @endif
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="{{route('index')}}">Anasayfaya Dön</a></div>
        </div>
@include('front.widgets.widget')


@endsection
