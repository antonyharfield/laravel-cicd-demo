<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;

class WeatherController extends Controller
{
    public function simple($city) {
        $weather = self::getRawData($city);
        $result = [
            'temperature' => intval($weather['main']['temp'])/10,
            'humidity' => $weather['main']['humidity'],
            'description' => $weather['weather'][0]['description']
        ];
        return response()->json($result);
    }

    private function getRawData($city) {
        $http = new HttpClient;
        $url = 'https://api.openweathermap.org/data/2.5/weather';
        $query = "q=$city&mode=json&appid=6a0adcdefb87047c8609ee75c101f2c0";
        $response = $http->get($url.'?'.$query);
        return json_decode((string) $response->getBody(), true);
    }
}

