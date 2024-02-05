<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketDataController extends Controller
{
    /**
     * Main Market Data Page
     */
    public function index()
    {
        return view('pages.front.market-data.index', [
            'title' => 'Market Data'
        ]);
    }

    /**
     * Highest IV Option contracts Page
     */
    public function highestIVOptions()
    {
        return view('pages.front.market-data.highest-iv-options', [
            'title' => 'Highest IV Option contracts'
        ]);
    }

    /**
     * Highest Volume Option contracts Page
     */
    public function highestVolumeOptions()
    {
        return view('pages.front.market-data.highest-volume-options', [
            'title' => 'Highest Volume Option contracts'
        ]);
    }

    /**
     * Lowest IV Option contracts Page
     */
    public function lowestIVOptions()
    {
        return view('pages.front.market-data.lowest-iv-options', [
            'title' => 'Lowest IV Option contracts'
        ]);
    }

    /**
     * Lowest Volume Option contracts Page
     */
    public function lowestVolumeOptions()
    {
        return view('pages.front.market-data.lowest-volume-options', [
            'title' => 'Lowest Volume Option contracts'
        ]);
    }

    /**
     * EOD option prices Page
     */
    public function eodOptionChains($symbol, $date)
    {
        return view('pages.front.market-data.eod-option-chains', [
            'title' => 'EOD option prices',
            'symbol' => $symbol,
            'date' => $date
        ]);
    }

    /**
     * List of all stocks with tradable options Page
     */
    public function allUsaStocks()
    {
        return view('pages.front.market-data.all-usa-stocks', [
            'title' => 'List of all stocks with tradable options'
        ]);
    }

    /**
     * Stocks listed by MarketCap Page
     */
    public function stockByMarketCap()
    {
        return view('pages.front.market-data.stocks-by-market-cap', [
            'title' => 'Stocks listed by MarketCap'
        ]);
    }

    /**
     * Highest Beta Stocks Page
     */
    public function highestBetaStocks()
    {
        return view('pages.front.market-data.highest-beta-stocks', [
            'title' => 'Highest Beta Stocks'
        ]);
    }

    /**
     * Lowest Beta stocks Page
     */
    public function lowestBetaStocks()
    {
        return view('pages.front.market-data.lowest-beta-stocks', [
            'title' => 'Lowest Beta stocks'
        ]);
    }

    /**
     * EOD stock data Page
     */
    public function eodStockPrices($symbol, $date)
    {
        return view('pages.front.market-data.eod-stock-prices', [
            'title' => 'EOD stock data',
            'symbol' => $symbol,
            'date' => $date
        ]);
    }

    /**
     * Dividend History Page
     */
    public function dividendHistory($symbol)
    {
        return view('pages.front.market-data.dividend-history', [
            'title' => 'Dividend History',
            'symbol' => $symbol
        ]);
    }

    /**
     * Stocks with highest dividend yield Page
     */
    public function highestDividendYieldStocks()
    {
        return view('pages.front.market-data.highest-dividend-yield-stocks', [
            'title' => 'Stocks with highest dividend yield'
        ]);
    }

    /**
     * Upcoming ex-dividend dates Page
     */
    public function upcomingExDividendDates()
    {
        return view('pages.front.market-data.upcoming-ex-dividend-dates', [
            'title' => 'Upcoming ex-dividend dates'
        ]);
    }

    /**
     * Stocks with monthly dividends Page
     */
    public function monthlyDividendStocks()
    {
        return view('pages.front.market-data.monthly-dividend-stocks', [
            'title' => 'Stocks with monthly dividends'
        ]);
    }

    /**
     * Stock Analysts Estimates, Ratings and Price Targets Page
     */
    public function ratingAnalystsPrediction($symbol)
    {
        return view('pages.front.market-data.rating-analysts-prediction', [
            'title' => 'Stock Analysts Estimates, Ratings and Price Targets',
            'symbol' => $symbol
        ]);
    }
}
