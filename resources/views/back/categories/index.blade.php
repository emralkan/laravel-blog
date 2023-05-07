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
                                    <a category-id="{{$category->id}}" class="btn btn-sm btn-primary edit-click" title="Düzenle" ><i class="fa fa-edit text-white"</i> </a>
                                    <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->postCount()}}" class="btn btn-sm btn-danger remove-click" title="Kategoriyi Sil" ><i class="fa fa-times text-white"</i> </a>
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
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.category.update')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" id="category" class="form-control" name="category" >
                            <input type="hidden" name="id" id="category_id">
                        </div>
                        <div class="form-group">
                            <label> Kategori Slug</label>
                            <input id="slug" type="text" class="form-control" name="slug">
                        </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal" id="deleteModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Sil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="body" class="modal-body">
                    <div class="alert alert-danger" id="postAlert"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <form method="post" action="{{route('admin.category.delete')}}">
                        @csrf
                        <input type="hidden" name="id" id="deleteId">
                    <button id="deleteButton" type="submit" class="btn btn-success">Sil</button>
                    </form>
                </div>
                </form>
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
            $('.remove-click').click(function () {
                id = $(this)[0].getAttribute('category-id');
                count = $(this)[0].getAttribute('category-count');
                name = $(this)[0].getAttribute('category-name');
                if(id==21){
                $('#postAlert'). html(name+ ' Kategorisi Sabit Kategoridir. Silinen kategorilere ait makaleler buraya eklenecektir.');
                $('#body').show();
                $('#deleteButton').hide();
                $('#deleteModel').modal();
                return;
                }

                $('#deleteButton').show();
                $('#deleteId'). val(id);
                $('#postAlert'). html('');
                $('#body').hide();
                if(count>0){
                    $('#postAlert'). html('Bu kategoriye ait '+count+' makale bulunuyor. Silmek istediğinize emin misiniz ? ');
                    $('#body').show();
                }
                    $('#deleteModel').modal();
            });

            $('.edit-click').click(function () {
                id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type:'GET',
                    url:'{{route('admin.category.getdata')}}',
                    data:{id:id},
                    success:function (data) {
                        console.log(data);
                        $('#category'). val(data.name);
                        $('#slug'). val(data.slug);
                        $('#category_id'). val(data.id);
                        $('#editModal'). modal();
                    }
                });
            });


            $('.switch').change(function() {
                id = $(this)[0].getAttribute('category-id');
                statu=$(this).prop('checked');
                $.get("{{route('admin.category.switch')}}", {id:id, statu:statu},  function(data, status){});
            })
        })
    </script>
@endsection
