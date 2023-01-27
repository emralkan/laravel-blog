@extends('back.layouts.master')
@section('title', 'Makaleler')
@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$posts->count()}}</strong>  Makale Bulundu</h6>
            <a href="{{route('admin.trashed.post')}}" class="float-right btn btn-warning btn-xl"><i class="fa fa-trash"></i>Silinen Makaleler</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Kategori</th>
                        <th>Yayın Tarihi</th>
                        <th>Durum</th>
                        <th>Seçenekler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)

                        <tr>
                        <td>
                            <img src="{{asset($post->image)}}" width="100px" >
                        </td>
                        <td>{{$post->getCategory->name}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>
                            <input class="switch" post-id="{{$post->id}}" type="checkbox" data-offStyle="danger" data-onStyle="success" data-on="Aktif" data-off="Pasif" @if($post->status==1) checked @endif data-toggle="toggle">
                        </td>
                        <td>
                            <a target="_blank" href="{{route('post', $post->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.makaleler.edit', $post->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('admin.delete.post', $post->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
               id = $(this)[0].getAttribute('post-id');
               statu=$(this).prop('checked');
                $.get("{{route('admin.switch')}}", {id:id, statu:statu},  function(data, status){});
            })
        })
    </script>
@endsection



