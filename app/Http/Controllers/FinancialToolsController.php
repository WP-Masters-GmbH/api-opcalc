<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActualSymbols;

class FinancialToolsController extends Controller
{
    /**
     * Dollar Cost Averaging Calculator Page
     */
    public function dollarCostAveragingCalculator()
    {
        $symbols = ActualSymbols::pluck('symbol')->toArray();

        return view('pages.front.financial-tools.dollar-cost-averaging-calculator', [
            'title' => 'Dollar Cost Averaging Calculator',
            'symbols' => $symbols
        ]);
    }

    /**
     * Earning simulator Page
     */
    public function earningsSimulator()
    {
        return view('pages.front.financial-tools.earnings-simulator', [
            'title' => 'Earning simulator'
        ]);
    }
}
