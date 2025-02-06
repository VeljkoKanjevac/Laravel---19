@php use App\Models\CitiesModel;use App\Models\ForecastsModel; @endphp

<form method="POST" action="{{route("forecast.create")}}">

    @foreach($errors->all() as $error)
        <p>Greska: {{$error}}</p>
    @endforeach

    {{csrf_field()}}

    <select name="city_id">
        @foreach(CitiesModel::all() as $city)
            <option value="{{$city->id}}"> {{$city->name}} </option>
        @endforeach
    </select>

    <input type="number" name="temperature" placeholder="Unesite temperaturu">

    <select name="weather_type">
        @foreach(ForecastsModel::WEATHERS as $weather_type)
            <option value="{{$weather_type}}"> {{$weather_type}} </option>
        @endforeach
    </select>

    <input type="number" name="probability" placeholder="Unesite sansu za padavine">

    <input type="date" name="forecast_date">

    <button>Snimi</button>

</form>

@foreach(CitiesModel::all() as $city)

    <div>
        <ul> <h4>{{$city->name}}</h4>

            @foreach($city->forecasts as $forecast)
                   <li>
                       <p>{{$forecast->forecast_date}}------{{$forecast->temperature}}</p>
                   </li>
            @endforeach

        </ul>
    </div>

@endforeach
