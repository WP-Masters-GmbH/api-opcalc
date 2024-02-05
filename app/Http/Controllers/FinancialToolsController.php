<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinancialToolsController extends Controller
{
    /**
     * Dollar Cost Averaging Calculator Page
     */
    public function dollarCostAveragingCalculator()
    {
        return view('pages.front.financial-tools.dollar-cost-averaging-calculator', [
            'title' => 'Dollar Cost Averaging Calculator'
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
