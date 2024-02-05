<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketDataController extends Controller
{
    /**
     * Main Market Page
     */
    public function index()
    {
        return view('pages.front.market-data.index', [
            'title' => 'Market Data'
        ]);
    }
}
