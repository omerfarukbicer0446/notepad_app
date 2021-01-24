@extends('layout.master')
@section('title')
    Ana Sayfa
@endsection
@section('content')

<div class="m-5">
  <div class="row row-cols-1 row-cols-md-3 mb-4 g-4">
    @csrf
    @foreach ($notes as $key => $value)
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ substr($value->title,0,31) }}</h5>
            <p class="card-text">{{ substr($value->note,0,100) }}</p>
            <button type="button" data-id="{{ $value->id }}" class="delete btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(255, 255, 255, 1);transform:;-ms-filter:"><path fill="none" d="M17.004 20L17.003 8h-1-8-1v12H17.004zM13.003 10h2v8h-2V10zM9.003 10h2v8h-2V10zM9.003 4H15.003V6H9.003z"></path><path d="M5.003,20c0,1.103,0.897,2,2,2h10c1.103,0,2-0.897,2-2V8h2V6h-3h-1V4c0-1.103-0.897-2-2-2h-6c-1.103,0-2,0.897-2,2v2h-1h-3 v2h2V20z M9.003,4h6v2h-6V4z M8.003,8h8h1l0.001,12H7.003V8H8.003z"></path><path d="M9.003 10H11.003V18H9.003zM13.003 10H15.003V18H13.003z"></path></svg></button>
            <a href="{{ route('get.list.note', ['slug' => $value->slug]) }}" class="show btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(255, 255, 255, 1);transform:;-ms-filter:"><path d="M14,12c-1.095,0-2-0.905-2-2c0-0.354,0.103-0.683,0.268-0.973C12.178,9.02,12.092,9,12,9c-1.642,0-3,1.359-3,3 c0,1.642,1.358,3,3,3c1.641,0,3-1.358,3-3c0-0.092-0.02-0.178-0.027-0.268C14.683,11.897,14.354,12,14,12z"></path><path d="M12,5c-7.633,0-9.927,6.617-9.948,6.684L1.946,12l0.105,0.316C2.073,12.383,4.367,19,12,19s9.927-6.617,9.948-6.684 L22.054,12l-0.105-0.316C21.927,11.617,19.633,5,12,5z M12,17c-5.351,0-7.424-3.846-7.926-5C4.578,10.842,6.652,7,12,7 c5.351,0,7.424,3.846,7.926,5C19.422,13.158,17.348,17,12,17z"></path></svg></a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<div class="position-fixed bottom-0 end-0">
  <button id="new_note" style="margin:15px;width:48px;height:48px;border-radius:50%;display:flex;justify-content:center;align-items:center;" type="button" class="btn btn-dark">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(255, 255, 255, 1);transform:;-ms-filter:"><path d="M19 11L13 11 13 5 11 5 11 11 5 11 5 13 11 13 11 19 13 19 13 13 19 13z"></path></svg>
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
      window.location.href = "{{ route('get.new.note') }}";
    })
    $(".delete").on("click",function () {
      $.ajax({
        type: "POST",
        url: "{{route('post.delete.note')}}",
        data: {"id":$(this).attr("data-id"),"_token":"{{csrf_token()}}"},
        success: function (response) {
          if (response == "success") {
            window.location.href = "{{ route('get.home') }}";
          }
        }
      });
    })
  </script>
@endsection