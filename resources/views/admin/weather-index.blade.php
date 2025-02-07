<form method="post" action="{{route("weather.update")}}">

    {{csrf_field()}}

    <input type="number" name="temperature" placeholder="Unesite temperaturu:">

    <select name="city_id">
        @foreach(\App\Models\CitiesModel::all() as $city)
            <option value="{{$city->id}}"> {{$city->name}} </option>
        @endforeach
    </select>

    <button>SNIMI</button>

</form>

@foreach(\App\Models\WeatherModel::with("city")->get() as $weather)
    <p>{{$weather->city->name}} - {{$weather->temperature}}</p>
@endforeach
