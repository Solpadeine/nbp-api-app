<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct(private CurrencyService $currencyService)
    {
    }
    public function sync()
    {
        return $this->currencyService->fetch();
    }
}
