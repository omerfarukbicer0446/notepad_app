@extends('layout.master')
@section('title')
    Giriş Yap
@endsection
@section('content')
<div class="position-absolute top-50 start-50 translate-middle">
  <div class="card" style="min-width: 350px;">
    <div class="card-body">
      @if ($request->session()->has('error.invalid'))
        <div class="alert alert-danger" role="alert">
          E-Posta adresiniz ve ya Şifreniz yanlış
        </div> 
      @endif
      @if ($request->session()->has('error.null'))
        <div class="alert alert-warning" role="alert">
          Tüm alanları doldurmanız lazım!
        </div> 
      @endif
      <form method="POST" action="{{route('post.login')}}">
        @csrf

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">E-Posta Adresi</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Şifre</label>
          <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Giriş Yap</button>
        <a href="{{route("get.register")}}" class="btn btn-dark">Kayıt ol</a>
      </form>
    </div>
  </div>
</div>
@endsection