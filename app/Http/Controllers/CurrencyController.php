<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Services\CurrencyService;

class CurrencyController extends Controller
{
    public function __construct(private CurrencyService $currencyService)
    {
    }

    public function index()
    {
        $currencies = Currency::all();
        return view('currencies', ['currencies' => $currencies]);
    }

    public function sync()
    {
        $this->currencyService->sync();
    }
}
