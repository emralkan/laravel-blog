@extends('back.layouts.master')
@section('title', 'Tüm Kategoriler')
@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('category.create')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" class="form-control" name="category">
                        </div>
                        <input type="submit" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Kategori Adı</th>
                            <th>Makale Sayısı</th>
                            <th>Durum</th>
                            <th>Seçenekler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)

                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->postCount()}}</td>
                                <td>
                                    <input class="switch" category-id="{{$category->id}}" type="checkbox" data-offStyle="danger" data-onStyle="success" data-on="Aktif" data-off="Pasif" @if($category->status==1) checked @endif data-toggle="toggle">
                                </td>
                                <td>
                                    <a target="_blank" href="{{route('post', $category->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('admin.makaleler.edit', $category->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                    <a href="{{route('admin.delete.post', $category->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
                id = $(this)[0].getAttribute('category-id');
                statu=$(this).prop('checked');
                $.get("{{route('admin.category.switch')}}", {id:id, statu:statu},  function(data, status){});
            })
        })
    </script>
@endsection
