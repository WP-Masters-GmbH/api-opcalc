<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockPrice;
use App\Models\StockHistory;
use App\Models\EOD_OptionQuotes;
use App\Models\EOD_StockQuotes;
use App\Models\DividendHistory;
use App\Models\EarningsEstimate;
use Illuminate\Support\Facades\DB;
use App\Models\ActualSymbols;
use App\Services\Controllers\OptionChainService;
use App\Models\DividendStocks;
use App\Models\Ratings;

class MarketDataController extends Controller
{
    private array $stocks = ['MSFT', 'AAPL', 'GOOGL', 'AMZN', 'NVDA', 'META', 'BRK.B', 'LLY', 'TSLA', 'AVGO', 'V', 'TSM', 'JPM', 'NVO', 'UNH', 'WMT', 'MA', 'XOM', 'JNJ', 'PG', 'HD', 'ASML', 'MRK', 'ORCL', 'COST', 'ABBV', 'AMD', 'ADBE', 'CVX', 'CRM', 'TM', 'BAC', 'KO', 'NFLX', 'PEP', 'ACN', 'MCD', 'TMO', 'SAP', 'NVS', 'SHEL', 'CSCO', 'AZN', 'LIN', 'ABT', 'TMUS', 'BABA', 'DHR', 'CMCSA', 'INTC', 'INTU', 'WFC', 'DIS', 'VZ', 'AMGN', 'IBM', 'PDD', 'CAT', 'NOW', 'QCOM', 'BHP', 'TTE', 'NKE', 'PFE', 'HSBC', 'UNP', 'AXP', 'BX', 'GE', 'TXN', 'PM', 'SPGI', 'MS', 'UBER', 'AMAT', 'RY', 'ISRG', 'RTX', 'COP', 'SYK', 'HON', 'HDB', 'T', 'BA', 'GS', 'LOW', 'BKNG', 'BUD', 'UL', 'SONY', 'UPS', 'RIO', 'PLD', 'NEE', 'SNY', 'BLK', 'MDT', 'ELV', 'SCHW'];

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
        // Prepare Variables
        $month = date('F');
        $year = date('Y');
        $table_data = [];

        // Get Data
        $options_list = EOD_OptionQuotes::select('eod_option_quotes.*')
            ->joinSub(
                EOD_OptionQuotes::select('symbol', DB::raw('MAX(date) as latest_date'))
                    ->groupBy('symbol'),
                'latest_dates',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'latest_dates.symbol')
                        ->on('eod_option_quotes.date', '=', 'latest_dates.latest_date');
                }
            )
            ->joinSub(
                EOD_OptionQuotes::select('symbol', 'date', DB::raw('MAX(volatility) as max_volatility'))
                    ->groupBy('symbol', 'date'),
                'max_volatilities',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'max_volatilities.symbol')
                        ->on('eod_option_quotes.date', '=', 'max_volatilities.date')
                        ->on('eod_option_quotes.volatility', '=', 'max_volatilities.max_volatility');
                }
            )
            ->orderBy('eod_option_quotes.symbol')
            ->orderBy('eod_option_quotes.volatility', 'DESC')
            ->distinct('eod_option_quotes.symbol')
            ->take(500)
            ->get()
            ->toArray();

        $symbols = EOD_OptionQuotes::getSymbolsFromRows($options_list);

        // Get Data
        $stocks_list = StockPrice::select('stock_quotes.*')
            ->joinSub(
                StockPrice::select('symbol', DB::raw('MAX(quotedate) as latest_date'))
                    ->whereIn('symbol', $symbols) // Добавляем фильтрацию по символам
                    ->groupBy('symbol'),
                'latest_dates',
                function ($join) {
                    $join->on('stock_quotes.symbol', '=', 'latest_dates.symbol')
                        ->on('stock_quotes.quotedate', '=', 'latest_dates.latest_date');
                }
            )
            ->whereIn('stock_quotes.symbol', $symbols) // Дополнительная фильтрация после соединения
            ->get()
            ->toArray();

        $latestIds = EarningsEstimate::selectRaw('MAX(id) as max_id')
            ->whereIn('symbol', $symbols) // Добавляем фильтрацию по символам
            ->groupBy('symbol');

        $uniqueEarningsEstimates = EarningsEstimate::joinSub($latestIds, 'latest_ids', function ($join) {
            $join->on('earnings_estimate.id', '=', 'latest_ids.max_id');
        })
            ->whereIn('earnings_estimate.symbol', $symbols) // Дополнительная фильтрация после соединения
            ->orderBy('earnings_estimate.id', 'desc')
            ->get()
            ->toArray();

        // Prepare Table Data
        $table_data = EOD_OptionQuotes::prepareHighestIVTable($options_list);
        $stocks = StockPrice::prepareStocksSymbolsData($stocks_list);
        $earnings_estimates = EarningsEstimate::prepareMarketData($uniqueEarningsEstimates);

        return view('pages.front.market-data.highest-iv-options', [
            'title' => "Highest IV Option contracts for {$month} {$year}",
            'month' => $month,
            'year' => $year,
            'table_data' => $table_data,
            'stocks_list' => $stocks,
            'earnings_estimates' => $earnings_estimates
        ]);
    }

    /**
     * Highest Volume Option contracts Page
     */
    public function highestVolumeOptions()
    {
        // Prepare Variables
        $month = date('F');
        $year = date('Y');
        $table_data = [];

        $options_list = EOD_OptionQuotes::select('eod_option_quotes.*')
            ->joinSub(
                EOD_OptionQuotes::select('symbol', DB::raw('MAX(date) as latest_date'))
                    ->groupBy('symbol'),
                'latest_dates',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'latest_dates.symbol')
                        ->on('eod_option_quotes.date', '=', 'latest_dates.latest_date');
                }
            )
            ->joinSub(
                EOD_OptionQuotes::select('symbol', 'date', DB::raw('MAX(volume) as max_volume'))
                    ->groupBy('symbol', 'date'),
                'max_volumes',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'max_volumes.symbol')
                        ->on('eod_option_quotes.date', '=', 'max_volumes.date')
                        ->on('eod_option_quotes.volume', '=', 'max_volumes.max_volume');
                }
            )
            ->orderBy('eod_option_quotes.symbol')
            ->orderBy('eod_option_quotes.volume', 'DESC')
            ->distinct('eod_option_quotes.symbol')
            ->take(500)
            ->get()
            ->toArray();

        $symbols = EOD_OptionQuotes::getSymbolsFromRows($options_list);

        // Get Data
        $stocks_list = StockPrice::select('stock_quotes.*')
            ->joinSub(
                StockPrice::select('symbol', DB::raw('MAX(quotedate) as latest_date'))
                    ->whereIn('symbol', $symbols) // Добавляем фильтрацию по символам
                    ->groupBy('symbol'),
                'latest_dates',
                function ($join) {
                    $join->on('stock_quotes.symbol', '=', 'latest_dates.symbol')
                        ->on('stock_quotes.quotedate', '=', 'latest_dates.latest_date');
                }
            )
            ->whereIn('stock_quotes.symbol', $symbols) // Дополнительная фильтрация после соединения
            ->get()
            ->toArray();

        $latestIds = EarningsEstimate::selectRaw('MAX(id) as max_id')
            ->whereIn('symbol', $symbols) // Добавляем фильтрацию по символам
            ->groupBy('symbol');

        $uniqueEarningsEstimates = EarningsEstimate::joinSub($latestIds, 'latest_ids', function ($join) {
            $join->on('earnings_estimate.id', '=', 'latest_ids.max_id');
        })
            ->whereIn('earnings_estimate.symbol', $symbols) // Дополнительная фильтрация после соединения
            ->orderBy('earnings_estimate.id', 'desc')
            ->get()
            ->toArray();

        // Prepare Table Data
        $table_data = EOD_OptionQuotes::prepareHighestVolumeTable($options_list);
        $stocks = StockPrice::prepareStocksSymbolsData($stocks_list);
        $earnings_estimates = EarningsEstimate::prepareMarketData($uniqueEarningsEstimates);

        return view('pages.front.market-data.highest-volume-options', [
            'title' => "Highest Volume Option contracts for {$month} {$year}",
            'month' => $month,
            'year' => $year,
            'table_data' => $table_data,
            'stocks_list' => $stocks,
            'earnings_estimates' => $earnings_estimates
        ]);
    }

    /**
     * Lowest IV Option contracts Page
     */
    public function lowestIVOptions()
    {
        // Prepare Variables
        $month = date('F');
        $year = date('Y');
        $table_data = [];

        // Get Data
        $options_list = EOD_OptionQuotes::select('eod_option_quotes.*')
            ->joinSub(
                EOD_OptionQuotes::select('symbol', DB::raw('MAX(date) as latest_date'))
                    ->groupBy('symbol'),
                'latest_dates',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'latest_dates.symbol')
                        ->on('eod_option_quotes.date', '=', 'latest_dates.latest_date');
                }
            )
            ->joinSub(
                EOD_OptionQuotes::select('symbol', 'date', DB::raw('MIN(volatility) as min_volatility'))
                    ->where('volatility', '>', 0)
                    ->groupBy('symbol', 'date'),
                'min_volatilities',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'min_volatilities.symbol')
                        ->on('eod_option_quotes.date', '=', 'min_volatilities.date')
                        ->whereRaw('eod_option_quotes.volatility = min_volatilities.min_volatility');
                }
            )
            ->orderBy('eod_option_quotes.symbol')
            ->orderBy('eod_option_quotes.volatility', 'ASC')
            ->distinct('eod_option_quotes.symbol')
            ->take(500)
            ->get()
            ->toArray();

        $symbols = EOD_OptionQuotes::getSymbolsFromRows($options_list);

        // Get Data
        $stocks_list = StockPrice::select('stock_quotes.*')
            ->joinSub(
                StockPrice::select('symbol', DB::raw('MAX(quotedate) as latest_date'))
                    ->whereIn('symbol', $symbols) // Добавляем фильтрацию по символам
                    ->groupBy('symbol'),
                'latest_dates',
                function ($join) {
                    $join->on('stock_quotes.symbol', '=', 'latest_dates.symbol')
                        ->on('stock_quotes.quotedate', '=', 'latest_dates.latest_date');
                }
            )
            ->whereIn('stock_quotes.symbol', $symbols) // Дополнительная фильтрация после соединения
            ->get()
            ->toArray();

        $latestIds = EarningsEstimate::selectRaw('MAX(id) as max_id')
            ->whereIn('symbol', $symbols) // Добавляем фильтрацию по символам
            ->groupBy('symbol');

        $uniqueEarningsEstimates = EarningsEstimate::joinSub($latestIds, 'latest_ids', function ($join) {
            $join->on('earnings_estimate.id', '=', 'latest_ids.max_id');
        })
            ->whereIn('earnings_estimate.symbol', $symbols) // Дополнительная фильтрация после соединения
            ->orderBy('earnings_estimate.id', 'desc')
            ->get()
            ->toArray();

        // Prepare Table Data
        $table_data = EOD_OptionQuotes::prepareLowestIVTable($options_list);
        $stocks = StockPrice::prepareStocksSymbolsData($stocks_list);
        $earnings_estimates = EarningsEstimate::prepareMarketData($uniqueEarningsEstimates);

        return view('pages.front.market-data.lowest-iv-options', [
            'title' => "Lowest IV Option contracts for {$month} {$year}",
            'month' => $month,
            'year' => $year,
            'table_data' => $table_data,
            'stocks_list' => $stocks,
            'earnings_estimates' => $earnings_estimates
        ]);
    }

    /**
     * Lowest Volume Option contracts Page
     */
    public function lowestVolumeOptions()
    {
        // Prepare Variables
        $month = date('F');
        $year = date('Y');
        $table_data = [];

        // Get Data
        $options_list = EOD_OptionQuotes::select('eod_option_quotes.*')
            ->joinSub(
                EOD_OptionQuotes::select('symbol', DB::raw('MAX(date) as latest_date'))
                    ->groupBy('symbol'),
                'latest_dates',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'latest_dates.symbol')
                        ->on('eod_option_quotes.date', '=', 'latest_dates.latest_date');
                }
            )
            ->joinSub(
                EOD_OptionQuotes::select('symbol', 'date', DB::raw('MIN(volume) as min_volume'))
                    ->where('volume', '>', 0)
                    ->groupBy('symbol', 'date'),
                'min_volumes',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'min_volumes.symbol')
                        ->on('eod_option_quotes.date', '=', 'min_volumes.date')
                        ->on('eod_option_quotes.volume', '=', 'min_volumes.min_volume');
                }
            )
            ->orderBy('eod_option_quotes.symbol')
            ->orderBy('eod_option_quotes.volume', 'ASC')
            ->distinct('eod_option_quotes.symbol')
            ->take(500)
            ->get()
            ->toArray();


        $symbols = EOD_OptionQuotes::getSymbolsFromRows($options_list);

        // Get Data
        $stocks_list = StockPrice::select('stock_quotes.*')
            ->joinSub(
                StockPrice::select('symbol', DB::raw('MAX(quotedate) as latest_date'))
                    ->whereIn('symbol', $symbols) // Добавляем фильтрацию по символам
                    ->groupBy('symbol'),
                'latest_dates',
                function ($join) {
                    $join->on('stock_quotes.symbol', '=', 'latest_dates.symbol')
                        ->on('stock_quotes.quotedate', '=', 'latest_dates.latest_date');
                }
            )
            ->whereIn('stock_quotes.symbol', $symbols) // Дополнительная фильтрация после соединения
            ->get()
            ->toArray();

        $latestIds = EarningsEstimate::selectRaw('MAX(id) as max_id')
            ->whereIn('symbol', $symbols) // Добавляем фильтрацию по символам
            ->groupBy('symbol');

        $uniqueEarningsEstimates = EarningsEstimate::joinSub($latestIds, 'latest_ids', function ($join) {
            $join->on('earnings_estimate.id', '=', 'latest_ids.max_id');
        })
            ->whereIn('earnings_estimate.symbol', $symbols) // Дополнительная фильтрация после соединения
            ->orderBy('earnings_estimate.id', 'desc')
            ->get()
            ->toArray();

        // Prepare Table Data
        $table_data = EOD_OptionQuotes::prepareLowestVolumeTable($options_list);
        $stocks = StockPrice::prepareStocksSymbolsData($stocks_list);
        $earnings_estimates = EarningsEstimate::prepareMarketData($uniqueEarningsEstimates);

        return view('pages.front.market-data.lowest-volume-options', [
            'title' => "Lowest Volume Option contracts for {$month} {$year}",
            'month' => $month,
            'year' => $year,
            'table_data' => $table_data,
            'stocks_list' => $stocks,
            'earnings_estimates' => $earnings_estimates
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
        $symbols = ActualSymbols::pluck('symbol')->toArray();
        $eod_stocks = EOD_StockQuotes::whereIn('symbol', $symbols)->get()->toArray();
        $table_data = EOD_StockQuotes::prepareMarketData($eod_stocks);

        return view('pages.front.market-data.stocks-by-market-cap', [
            'title' => 'Stocks listed by MarketCap',
            'table_data' => $table_data
        ]);
    }

    /**
     * Highest Beta Stocks Page
     */
    public function highestBetaStocks()
    {
        // Prepare Variables
        $stocks = $this->stocks;
        $month = date('F');
        $year = date('Y');
        $table_data = [];

        // Get Data
        $stocks_list = StockPrice::whereIn('symbol', $stocks)
            ->whereIn('quotedate', function ($query) use ($stocks) {
                $query->selectRaw('quotedate')
                    ->from('stock_quotes')
                    ->whereIn('symbol', $stocks)
                    ->groupBy('symbol', 'quotedate')
                    ->orderBy('symbol')
                    ->orderBy('quotedate', 'desc')
                    ->limit(2);
            })
            ->get()
            ->toArray();

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
        $stocks = $this->stocks;
        $month = date('F');
        $year = date('Y');
        $table_data = [];

        // Get Data
        $stocks_list = StockPrice::whereIn('symbol', $stocks)
            ->whereIn('quotedate', function ($query) use ($stocks) {
                $query->selectRaw('quotedate')
                    ->from('stock_quotes')
                    ->whereIn('symbol', $stocks)
                    ->groupBy('symbol', 'quotedate')
                    ->orderBy('symbol')
                    ->orderBy('quotedate', 'desc')
                    ->limit(2);
            })
            ->get()
            ->toArray();

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
    public function eodStockPrices($symbol)
    {
        $table_data = EOD_StockQuotes::where('symbol', $symbol)->get()->toArray();

        return view('pages.front.market-data.eod-stock-prices', [
            'title' => 'EOD stock data',
            'symbol' => $symbol,
            'table_data' => $table_data
        ]);
    }

    /**
     * Dividend History Page
     */
    public function dividendHistory($symbol)
    {
        $table_data = DividendHistory::where('symbol', $symbol)->orderBy('ex_date', 'desc')->get()->toArray();

        return view('pages.front.market-data.dividend-history', [
            'title' => 'Dividend History',
            'symbol' => $symbol,
            'first_date' => !empty($table_data) ? end($table_data)['ex_date'] : date('Y-m-d'),
            'current_date' => !empty($table_data) ? $table_data[0]['ex_date'] : date('Y-m-d'),
            'table_data' => $table_data
        ]);
    }

    /**
     * Stocks with highest dividend yield Page
     */
    public function highestDividendYieldStocks()
    {
        $symbols = ActualSymbols::pluck('symbol')->toArray();
        $eod_stocks = EOD_StockQuotes::whereIn('symbol', $symbols)->get()->toArray();
        $table_data = EOD_StockQuotes::prepareMarketData($eod_stocks);

        $dividends = DividendStocks::whereIn('symbol', $symbols)->get()->toArray();
        $dividendsData = DividendStocks::prepareDevidents($dividends);

        return view('pages.front.market-data.highest-dividend-yield-stocks', [
            'title' => 'Stocks with highest dividend yield',
            'table_data' => $table_data,
            'dividendsData' => $dividendsData
        ]);
    }

    /**
     * Upcoming ex-dividend dates Page
     */
    public function upcomingExDividendDates()
    {
        $symbols = ActualSymbols::pluck('symbol')->toArray();
        $eod_stocks = EOD_StockQuotes::whereIn('symbol', $symbols)->get()->toArray();
        $table_data = EOD_StockQuotes::prepareMarketData($eod_stocks);

        $dividends = DividendStocks::whereIn('symbol', $symbols)->get()->toArray();
        $dividendsData = DividendStocks::prepareDevidents($dividends);

        return view('pages.front.market-data.upcoming-ex-dividend-dates', [
            'title' => 'Upcoming ex-dividend dates',
            'table_data' => $table_data,
            'dividendsData' => $dividendsData
        ]);
    }

    /**
     * Stocks with monthly dividends Page
     */
    public function monthlyDividendStocks()
    {
        $symbols = ActualSymbols::pluck('symbol')->toArray();
        $eod_stocks = EOD_StockQuotes::whereIn('symbol', $symbols)->get()->toArray();
        $table_data = EOD_StockQuotes::prepareMarketData($eod_stocks);

        $dividends = DividendStocks::whereIn('symbol', $symbols)->get()->toArray();
        $dividendsData = DividendStocks::prepareDevidents($dividends);

        return view('pages.front.market-data.monthly-dividend-stocks', [
            'title' => 'Stocks with monthly dividends',
            'table_data' => $table_data,
            'dividendsData' => $dividendsData
        ]);
    }

    /**
     * Stock Analysts Estimates, Ratings and Price Targets Page
     */
    public function ratingAnalystsPrediction($symbol)
    {
        $ratingData = Ratings::where('symbol', $symbol)
            ->orderBy('id', 'desc')
            ->first();

        return view('pages.front.market-data.rating-analysts-prediction', [
            'title' => 'Stock Analysts Estimates, Ratings and Price Targets',
            'symbol' => $symbol,
            'ratingData' => $ratingData,
            'analysts' => json_decode($ratingData['analysts'], true)
        ]);
    }

    /**
     * Search Chain Page
     */
    public function optionChainSearch()
    {
        return view('pages.front.market-data.option-chain-search', [
            'title' => 'Chain Search'
        ]);
    }

    /**
     * Search Chain Symbol Page
     */
    public function optionChainSymbol(Request $request, OptionChainService $service)
    {
        $symbol = $request->route('symbol');
        $date = $request->route('date');
        [$dates, $calls, $puts, $strikes, $startDate, $currentStockInfo] = $service->getData($symbol, $date);
        $fact = $service->getRandomFact();

        if(!$startDate) {
            $startDate = date('Y-m-d');
        }

        $usFormatedStartDate = $service->getFormatedStartDate($startDate);

        $title = "Chains Symbol {$symbol}";

        $symbols = $this->stocks;

        return view(
            'pages.front.market-data.option-chain-symbol',
            compact(
                'symbol',
                'symbols',
                'fact',
                'title',
                'dates',
                'calls',
                'puts',
                'strikes',
                'startDate',
                'usFormatedStartDate',
                'currentStockInfo'
            )
        );
    }
}
