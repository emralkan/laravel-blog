@extends('back.layouts.master')
@section('title', 'Makaleler')
@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$pages->count()}}</strong>  Sayfa Bulundu</h6>
         </div>

        <div class="card-body">
            <div id="orderSuccess" style="display:none;" class="alert alert-success">
                Değişiklikler başarıyla kaydedildi.
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody id="orders"> 
                    @foreach($pages as $page)
                        <tr id="page_{{$page->id}}">
                        <td>
                            <i class= "fa fa-arrows-alt-v fa-2x handle" style="cursor:move"></i>
                        </td>
                        <td>
                            <img src="{{asset($page->image)}}" width="100px" >
                        </td>
                        <td>{{$page->title}}</td>
                        <td>
                            <input class="switch" pages-id="{{$page->id}}" type="checkbox" data-offStyle="danger" data-onStyle="success" data-on="Aktif" data-off="Pasif" @if($page->status==1) checked @endif data-toggle="toggle">
                        </td>
                        <td>
                            <a target="_blank" href="{{route('page', $page->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.page.edit', $page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('admin.page.delete', $page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        $('#orders').sortable({
            handle:'.handle' ,
            update:function(){
               var siralama = $('#orders').sortable('serialize');
               $.get("{{route('admin.page.orders')}}?"+siralama,function(data,status){
                $("#orderSuccess").show().delay(1000).fadeOut();

               });
            }
        });
    </script>
    <script>
        $(function() {
            $('.switch').change(function() {
               id = $(this)[0].getAttribute('pages-id');
               statu=$(this).prop('checked');
                $.get("{{route('admin.page.switch')}}", {id:id, statu:statu},  function(data, status){
                    console.log(data);

                });
            })
        })
    </script>
@endsection



