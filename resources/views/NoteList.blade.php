@extends('layout.master')
@section('title')
    Notunu gör
@endsection
@section('content')
<div class="position-absolute top-50 start-50 translate-middle">
    <div class="card" style="width: 80vw;height: 90vh">
        <div class="card-body">
          @if ($request->session()->exists('error.null'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Boş alan!</strong> Tüm alanları doldurun
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          @if ($request->session()->exists('error.error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Hata!</strong> Sistemsel bir hata tekrar deneyin
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <form action="{{ route("post.update.note") }}" method="POST">
            @csrf

            <div class="form-floating mb-2">
                <input type="text" name="title" maxlength="255" value="@if ($request->session()->exists('title')){{ session('title') }}@else{{ $note->title }}@endif" class="form-control" id="floatingInputValue" placeholder="Başlık">
                <label for="floatingInputValue">*Başlık (255)</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="note" style="max-height: 70%;height: 74vh;resize:none;" placeholder="Notunuz" id="floatingTextarea2">@if ($request->session()->exists('note')){{ session('note') }}@else{{ $note->note }}@endif</textarea>
                <label for="floatingTextarea2">*Not (yazabildiğin kadar yaz)</label>
            </div>
            <input type="hidden" name="slug" value="{{ Str::slug($note->slug, '-') }}">
            <input type="hidden" name="id" value="{{ $note->id }}">
            <button type="submit" class="btn btn-success mt-2">Güncelle</button>
          </form>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0">
    <button id="new_note" style="margin:15px;width:48px;height:48px;border-radius:50%;display:flex;justify-content:center;align-items:center;" type="button" class="btn btn-dark">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(255, 255, 255, 1);transform:;-ms-filter:"><path d="M13.939 4.939L6.879 12 13.939 19.061 16.061 16.939 11.121 12 16.061 7.061z"></path></svg>
    </button>
</div>
<div class="position-fixed end-0" style="bottom:55px;">
  <a href="{{route("get.logout")}}" style="margin:15px;width:48px;height:48px;border-radius:50%;display:flex;justify-content:center;align-items:center;" type="button" class="btn btn-danger">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(255, 255, 255, 1);transform:;-ms-filter:"><path d="M16 13L16 11 7 11 7 8 2 12 7 16 7 13z"></path><path d="M20,3h-9C9.897,3,9,3.897,9,5v4h2V5h9v14h-9v-4H9v4c0,1.103,0.897,2,2,2h9c1.103,0,2-0.897,2-2V5C22,3.897,21.103,3,20,3z"></path></svg>
  </a>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $("#new_note").on("click",function() {
    window.location.href = "{{ route('get.home') }}";
  })
</script>
@endsection