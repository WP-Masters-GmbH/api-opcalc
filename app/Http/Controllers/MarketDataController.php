<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockPrice;
use App\Models\StockHistory;
use App\Models\EOD_StockQuotes;

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
        // Prepare Variables
        $stocks = ['MSFT', 'AAPL', 'GOOGL', 'AMZN', 'NVDA', 'META', 'BRK.B', 'LLY', 'TSLA', 'AVGO', 'V', 'TSM', 'JPM', 'NVO', 'UNH', 'WMT', 'MA', 'XOM', 'JNJ', 'PG', 'HD', 'ASML', 'MRK', 'ORCL', 'COST', 'ABBV', 'AMD', 'ADBE', 'CVX', 'CRM', 'TM', 'BAC', 'KO', 'NFLX', 'PEP', 'ACN', 'MCD', 'TMO', 'SAP', 'NVS', 'SHEL', 'CSCO', 'AZN', 'LIN', 'ABT', 'TMUS', 'BABA', 'DHR', 'CMCSA', 'INTC', 'INTU', 'WFC', 'DIS', 'VZ', 'AMGN', 'IBM', 'PDD', 'CAT', 'NOW', 'QCOM', 'BHP', 'TTE', 'NKE', 'PFE', 'HSBC', 'UNP', 'AXP', 'BX', 'GE', 'TXN', 'PM', 'SPGI', 'MS', 'UBER', 'AMAT', 'RY', 'ISRG', 'RTX', 'COP', 'SYK', 'HON', 'HDB', 'T', 'BA', 'GS', 'LOW', 'BKNG', 'BUD', 'UL', 'SONY', 'UPS', 'RIO', 'PLD', 'NEE', 'SNY', 'BLK', 'MDT', 'ELV', 'SCHW'];
        $month = date('F');
        $year = date('Y');
        $table_data = [];

        // Get Data
        $stocks_list = StockPrice::whereIn('symbol', $stocks)->whereYear('quotedate', '>=', 2020)->get()->toArray();
        $eod_stocks = EOD_StockQuotes::whereIn('symbol', $stocks)->get()->toArray();

        // Prepare Table Data
        $table_data = StockPrice::prepareBetaStocksData($stocks_list);
        $market_data = EOD_StockQuotes::prepareMarketData($eod_stocks);

        return view('pages.front.market-data.highest-beta-stocks', [
            'title' => "Highest Beta Stocks for {$month} {$year}",
            'month' => $month,
            'year' => $year,
            'table_data' => $table_data,
            'market_data' => $market_data
        ]);
    }

    /**
     * Lowest Beta stocks Page
     */
    public function lowestBetaStocks()
    {
        // Prepare Variables
        $stocks = ['MSFT', 'AAPL', 'GOOGL', 'AMZN', 'NVDA', 'META', 'BRK.B', 'LLY', 'TSLA', 'AVGO', 'V', 'TSM', 'JPM', 'NVO', 'UNH', 'WMT', 'MA', 'XOM', 'JNJ', 'PG', 'HD', 'ASML', 'MRK', 'ORCL', 'COST', 'ABBV', 'AMD', 'ADBE', 'CVX', 'CRM', 'TM', 'BAC', 'KO', 'NFLX', 'PEP', 'ACN', 'MCD', 'TMO', 'SAP', 'NVS', 'SHEL', 'CSCO', 'AZN', 'LIN', 'ABT', 'TMUS', 'BABA', 'DHR', 'CMCSA', 'INTC', 'INTU', 'WFC', 'DIS', 'VZ', 'AMGN', 'IBM', 'PDD', 'CAT', 'NOW', 'QCOM', 'BHP', 'TTE', 'NKE', 'PFE', 'HSBC', 'UNP', 'AXP', 'BX', 'GE', 'TXN', 'PM', 'SPGI', 'MS', 'UBER', 'AMAT', 'RY', 'ISRG', 'RTX', 'COP', 'SYK', 'HON', 'HDB', 'T', 'BA', 'GS', 'LOW', 'BKNG', 'BUD', 'UL', 'SONY', 'UPS', 'RIO', 'PLD', 'NEE', 'SNY', 'BLK', 'MDT', 'ELV', 'SCHW'];
        $month = date('F');
        $year = date('Y');
        $table_data = [];

        // Get Data
        $stocks_list = StockPrice::whereIn('symbol', $stocks)->whereYear('quotedate', '>=', 2020)->get()->toArray();
        $eod_stocks = EOD_StockQuotes::whereIn('symbol', $stocks)->get()->toArray();

        // Prepare Table Data
        $table_data = StockPrice::prepareBetaStocksData($stocks_list);
        $market_data = EOD_StockQuotes::prepareMarketData($eod_stocks);

        return view('pages.front.market-data.lowest-beta-stocks', [
            'title' => "Lowest Beta Stocks for {$month} {$year}",
            'month' => $month,
            'year' => $year,
            'table_data' => $table_data,
            'market_data' => $market_data
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
