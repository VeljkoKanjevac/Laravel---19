<?php

namespace App\Http;

class ForecastHelper
{

    const WEATHER_ICONS = [
        "rainy" => "fa-cloud-rain",
        "snowy" => "fa-snowflake",
        "sunny" => "fa-sun",
        "cloudy" => "fa-cloud",
    ];

    public static function getIconByWeatherType($type)
    {
        return match($type)
        {
            "rainy" => "fa-cloud-rain",
            "snowy" => "fa-snowflake",
            "sunny" => "fa-sun",
            "cloudy" => "fa-cloud",
            default => "fa-sun",
        };
    }

    public static function getColorByTemperature($temperature)
    {
        if ($temperature <= 0) {
            $boja = "lightblue";
        } else if ($temperature > 0 && $temperature <= 15) {
            $boja = "blue";
        } else if ($temperature > 15 && $temperature <= 25) {
            $boja = "green";
        } else {
            $boja = "red";
        }

        return $boja;
    }

}
