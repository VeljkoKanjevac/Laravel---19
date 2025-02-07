@extends("admin.layout")

@php    use App\Http\ForecastHelper;
 use App\Models\CitiesModel;
 use App\Models\ForecastsModel; @endphp

@section("sadrzajStranice")

    <form method="POST" action="{{route("forecast.create")}}" class="mb-5">

        <h2 class="mb-5">KREIRANJE NOVOG FORECASTA</h2>

        @foreach($errors->all() as $error)
            <p>Greska: {{$error}}</p>
        @endforeach

        {{csrf_field()}}

        <div class="d-flex col-6 flex-wrap">
            <div class="mb-3 col-6">
                <select name="city_id" class="form-select">
                    @foreach(CitiesModel::all() as $city)
                        <option value="{{$city->id}}"> {{$city->name}} </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-6">
                <input class="form-control" type="number" name="temperature" placeholder="Unesite temperaturu">
            </div>

            <div class="mb-3 col-6">
                <select name="weather_type" class="form-select">
                    @foreach(ForecastsModel::WEATHERS as $weather_type)
                        <option value="{{$weather_type}}"> {{$weather_type}} </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-6">
                <input class="form-control" type="number" name="probability" placeholder="Unesite sansu za padavine">
            </div>

            <div class="mb-3 col-6">
                <input class="form-control" type="date" name="forecast_date">
            </div>

            <button class="col-6">Snimi</button>
        </div>

    </form>

    <div class="d-flex flex-wrap" style="gap:10px">

        @foreach(CitiesModel::with("forecasts")->get() as $city)

            <div class="col-md-3">

                <h5 class="mb-1">{{$city->name}}</h5>
                <ul class="list-group mb-3">

                    @foreach($city->forecasts as $forecast)

                        @php
                            $boja = ForecastHelper::getColorByTemperature($forecast->temperature);
                            $ikonica = ForecastHelper::getIconByWeatherType($forecast->weather_type);
                        @endphp

                        <li class="list-group-item">
                            {{$forecast->forecast_date}}
                            <i class="fa-solid {{$ikonica}}"></i>
                            <span style="color:{{$boja}}"> {{$forecast->temperature}} </span>
                        </li>

                    @endforeach

                </ul>

            </div>

        @endforeach

    </div>

@endsection

