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
            if ($this->checkIfDoesntExists($item)) {
                $this->create($item);
            } else {
                $this->updateOrLeave($item);
            }
        }
    }

    public function fetch()
    {
        $url = 'http://api.nbp.pl/api/exchangerates/tables/a/';
        $response = Http::get($url);

        return json_decode($response->body());
    }

    public function checkIfDoesntExists($item)
    {
        return Currency::where('currency_code', $item->code)->doesntExist();
    }

    public function create($item)
    {
        Currency::create([
            'name' => $item->currency,
            'currency_code' => $item->code,
            'exchange_rate' => str_replace('.', '', $item->mid)
        ]);
    }

    public function updateOrLeave($item)
    {
        $currency = Currency::where('currency_code', $item->code)->firstOrFail();
        if ($currency->exchange_rate !== $item->mid) {
            $currency->update(['exchange_rate' => str_replace('.', '', $item->mid)]);
        }
    }
}
