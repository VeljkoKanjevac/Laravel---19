@php use App\Http\ForecastHelper; @endphp

@extends("layout")

@section("sadrzajStranice")

    <div class="d-flex flex-wrap container">

        @if(\Illuminate\Support\Facades\Session::has("error"))
            <div class="col-12 mb-5">
                <p class="text-danger fw-bold">{{\Illuminate\Support\Facades\Session::get("error")}}</p>
                <a class="btn btn-primary" href="/login">Ulogujte se</a>
            </div>
        @endif

        @foreach($cities as $city)

            @php $icon = ForecastHelper::getIconByWeatherType($city->todayForecast->weather_type) @endphp

            <p>
                @if(in_array($city->id, $userFavourites))
                    <a class="btn btn-primary" href="{{route("user.remove.favourite", ['city' => $city->id])}}">
                        <i class="fa-solid text-white fa-trash"></i>
                    </a>
                @else
                    <a class="btn btn-primary" href="{{route("user.add.favourite", ['city' => $city->id])}}">
                        <i class="fa-regular text-white fa-heart"></i>
                    </a>
                @endif

                <a class="btn btn-primary text-white me-4"
                   href="{{route("forecast.permalink", ['city' => $city->name])}}"><i
                        class="fa-solid {{$icon}}"></i> {{$city->name}}
                </a>
            </p>
        @endforeach
    </div>

@endsection
