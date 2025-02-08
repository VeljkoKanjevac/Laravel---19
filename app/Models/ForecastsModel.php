<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForecastsModel extends Model
{
    const WEATHERS = ['rainy', 'sunny', 'snowy', 'cloudy'];
    protected $table = 'forecasts';
    protected $fillable = [
        'city_id', 'temperature', 'forecast_date', 'weather_type', 'probability'
    ];

    public function city()
    {
        return $this->hasOne(CitiesModel::class, 'id', 'city_id');
    }
}
