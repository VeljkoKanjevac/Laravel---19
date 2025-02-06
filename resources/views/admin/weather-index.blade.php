<form>
    <input type="number" name="temperature" iplaceholder="Unesite temperaturu:">
    <select name="city_id">
        @foreach(\App\Models\CitiesModel::all() as $city)
            <option value="{{$city->id}}"> {{$city->name}} </option>
        @endforeach
    </select>
    <button>SNIMI</button>
</form>

@foreach(\App\Models\WeatherModel::all() as $weather)
    <p>{{$weather->city->name}} - {{$weather->temperature}}</p>
@endforeach
