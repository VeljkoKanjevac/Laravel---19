@extends("layout")

@section("sadrzajStranice")

    <form method="GET" action="{{route("forecast.search")}}">
        <div>
            <input type="text" name="city" placeholder="Unesite ime grada">
        </div>
        <button>Pronadji</button>
    </form>

@endsection
