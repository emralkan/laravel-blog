@extends('front.layouts.master')
@section('title', $data['page']->title)
@section('bg',$data['page']->image)
@section('content')

    <div class="col-lg-8 col-md-10 mx-auto">
    {{$data['page']->content}}
    </div>

@endsection

