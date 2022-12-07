<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function fetch()
    {
        $response = Http::get('http://api.nbp.pl/api/exchangerates/tables/a/');

        return json_decode($response->body());
    }
}
