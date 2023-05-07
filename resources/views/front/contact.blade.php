@extends('front.layouts.master')
@section('title', 'iletişim')
@section('content')
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Bizimle İletişime Geçin!</h4>
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                        </ul>
                    </div>
                @endif
                <p class="card-title-desc">Aşağıdaki Kutucukları Doldurarak Bizimle İletişime Geçebilirsiniz.</p>

                <form method="post" action="{{route('contact.post')}}" >
                    @csrf
                    <div class="mb-3 position-relative">
                        <label class="form-label">İsim</label>
                        <div>
                            <input name="name" type="text" value="{{old('name')}}" class="form-control"
                                   placeholder="İsminizi Giriniz." required />
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label class="form-label">E-Mail</label>
                        <div>
                            <input name="email" type="text" value="{{old('email')}}" class="form-control"
                                   placeholder="E-Mail Adresiniz" required />
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label class="form-label">Konu</label>
                        <div>
                            <select id="heard" class="form-control" name="topic" >
                                <option @if(old('topic')=="Bilgi") selected @endif>Bilgi</option>
                                <option @if(old('topic')=="Destek") selected @endif>Destek</option>
                                <option @if(old('topic')=="Genel") selected @endif>Genel</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label class="form-label">Mesajınız</label>
                        <div>
                            <input name="message" type="text" value="{{old('message')}}" class="form-control"
                                   placeholder="Mesajınızı Giriniz." required />
                        </div>
                    </div>
                    <div class="mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Gönder
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection



