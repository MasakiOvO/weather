<?php

namespace MaXiao\Weather;

use GuzzleHttp\Client;
use MaXiao\Weather\Exceptions\HttpException;
use MaXiao\Weather\Exceptions\InvaildArgumentException;

class Weather
{
    protected $key;

    protected $guzzleOptions = [];

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function getWeather($city, $type = 'base', $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

        if(!in_array(strtolower($format),['xml', 'json'])) {
            throw new InvaildArgumentException('Invaild response format: ' . $format);
        }

        if(!in_array(strtolower($type),['base', 'all'])) {
            throw new InvaildArgumentException('Invaild type value(base/all): ' . $type);
        }


        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'output' => $format,
            'extensions' => $type
        ]);

        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();
            return 'json' === $format ? \json_decode($response, true) : $response;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}


















