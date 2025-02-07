@php use Illuminate\Support\Facades\Session; @endphp
@extends("layout")

@section("sadrzajStranice")

    <form style="height:100vh; width: 100%"
          class="text-white text-left d-flex flex-wrap flex-column container justify-content-center align-items-center"
          method="GET" action="{{route("forecast.search")}}">

        <h1 class="col-md-4 col-12"><i class="fa-solid fa-house"></i> Pronadji svoj grad </h1>

        @if(Session::has("error"))
            <p class="text-danger"> {{ Session::get("error")  }} </p>
        @endif

        <div class="mb-3 col-md-4 col-12">
            <input class="form-control" type="text" name="city" placeholder="Unesite ime grada">
            <button class="btn btn-primary col-12 mt-3">Pronadji</button>
        </div>
    </form>

@endsection
