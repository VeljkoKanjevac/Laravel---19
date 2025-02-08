@php
    use App\Http\ForecastHelper;
    use Illuminate\Support\Facades\Session;
@endphp

@extends("layout")

@section("sadrzajStranice")

    <div class="d-flex justify-content-center">
        <table class="table text-white">
            <thead>
                <tr>
                    <th scope="col">CITY</th>
                    <th scope="col">TEMPERATURE</th>
                    <th scope="col">WEATHER TYPE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userFavourites as $userFavourite)
                    @php $icon = ForecastHelper::getIconByWeatherType($userFavourite->city->todayForecast->weather_type) @endphp
                    <tr>
                        <td>{{$userFavourite->city->name}}</td>
                        <td>{{$userFavourite->city->todayForecast->temperature}}</td>
                        <td><i class="fa-solid {{$icon}} mt-1"></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form style="height:50vh; width: 100%"
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
