<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function sync()
    {
        $currencies = $this->fetch();

        foreach ($currencies[0]->rates as $item) {
            $this->create($item);
        }
    }

    public function fetch()
    {
        $response = Http::get('http://api.nbp.pl/api/exchangerates/tables/a/');

        return json_decode($response->body());
    }

    public function create($item)
    {
        Currency::create([
            'name' => $item->currency,
            'currency_code' => $item->code,
            'exchange_rate' => str_replace('.', '', $item->mid)
        ]);
    }
}
