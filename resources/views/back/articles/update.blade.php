@extends('back.layouts.master')
@section('title', $makale->title.' '. 'makalesini düzenle')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.makaleler.update', $makale->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group" >
                    <label>Makale Başlığı</label>
                    <input type="text" name="title" value="{{$makale->title}}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kategori Türü</label>
                    <select class="form-control" name="category" required>
                        <option value="">Kategori Seçiniz</option>
                        @foreach ($categories as $category)
                            <option @if($makale->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Makale Fotoğrafı</label> <br>
                    <img src="{{asset($makale->image)}}" class="img-thumbnail rounded" width="300"> <br> <br>
                    <input type="file" name="image" value="{{$makale->image}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Makale İçeriği</label>
                    <textarea id="editor" name="conntent" class="form-control" rows="4"> {!! $makale->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('js')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote();
        });
    </script>
@endsection
