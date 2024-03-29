<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockPrice;
use App\Models\StockHistory;

class APIController extends Controller
{
    /**
     * Get All Stocks Prices
     */
    public function get_all_stock_prices()
    {
        return StockPrice::where('symbol', 'AA')->get();
    }

    /**
     * Get All Stocks History
     */
    public function get_all_stock_history()
    {
        return StockHistory::where('underlying_symbol', 'AA')->get();
    }
}
