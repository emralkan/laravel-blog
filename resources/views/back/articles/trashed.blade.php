@extends('back.layouts.master')
@section('title', 'Silinmiş Makaleler')
@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><strong>{{$posts->count()}}</strong>  Makale Bulundu</h6>
                <a href="{{route('admin.makaleler.index')}}" class="float-right btn btn-primary btn-xl">Yayındaki Makaleler</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Fotoğraf</th>
                            <th>Kategori</th>
                            <th>Silinme Tarihi</th>
                            <th>Seçenekler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)

                            <tr>
                                <td>
                                    <img src="{{$post->image}}" width="100px" >
                                </td>
                                <td>{{$post->getCategory->name}}</td>
                                <td>{{$post->deleted_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('admin.recover.post', $post->id)}}" title="Kurtar" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                                    <a href="{{route('admin.hard.delete.post', $post->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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


