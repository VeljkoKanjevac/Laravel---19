@foreach($city->forecasts as $forecast)
    <p>Datum: {{$forecast->forecast_date}} - Temperatura: {{$forecast->temperature}}</p>
@endforeach
