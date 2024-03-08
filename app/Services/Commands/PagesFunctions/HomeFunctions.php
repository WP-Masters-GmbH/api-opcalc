<?php

namespace App\Services\Commands\PagesFunctions;

use App\Models\ActualSymbols;
use App\Models\DividendStocks;
use App\Models\EarningsEstimate;
use App\Models\EOD_OptionQuotes;
use App\Models\EOD_StockQuotes;
use App\Models\StockPrice;
use Illuminate\Support\Facades\DB;

class HomeFunctions
{
    /**
     * Highest IV Rows for Home Table
     */
    public static function getHighestIVRows($countSymbols)
    {
        // Get Data
        $options_list = EOD_OptionQuotes::select('eod_option_quotes.*')
            ->joinSub(
                EOD_OptionQuotes::select('symbol', 'date', DB::raw('MAX(id) as max_id'))
                    ->groupBy('symbol', 'date'),
                'latest_ids',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'latest_ids.symbol')
                        ->on('eod_option_quotes.date', '=', 'latest_ids.date')
                        ->on('eod_option_quotes.id', '=', 'latest_ids.max_id');
                }
            )
            ->joinSub(
                EOD_OptionQuotes::select('symbol', 'date', 'id', DB::raw('MAX(volatility) as max_volatility'))
                    ->groupBy('symbol', 'date', 'id'),
                'max_volatilities',
                function ($join) {
                    $join->on('eod_option_quotes.symbol', '=', 'max_volatilities.symbol')
                        ->on('eod_option_quotes.date', '=', 'max_volatilities.date')
                        ->on('eod_option_quotes.id', '=', 'max_volatilities.id')
                        ->on('eod_option_quotes.volatility', '=', 'max_volatilities.max_volatility');
                }
            )
            ->orderBy('eod_option_quotes.volatility', 'DESC')
            ->orderBy('eod_option_quotes.symbol')
            ->distinct()
            ->take($countSymbols)
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

        return [$table_data, $stocks, $earnings_estimates];
    }

    /**
     * Highest Market Cap Rows for Home Table
     */
    public static function getHighestMarketCapRows($countSymbols)
    {
        $symbolsList = implode(',', array_map(function($item) {
            return "'" . $item . "'";
        }, ActualSymbols::pluck('symbol')->toArray()));

        // Подзапрос с ранжированием и сортировкой
        $subQuery = "(SELECT *,
                 RANK() OVER (PARTITION BY symbol ORDER BY date DESC,
                     CASE
                         WHEN market_cap IS NULL THEN 0
                         WHEN market_cap = '-' THEN 0
                         WHEN RIGHT(market_cap, 1) = 'B' THEN CAST(REPLACE(LEFT(market_cap, LENGTH(market_cap) - 1), ',', '') AS NUMERIC) * 1e9
                         WHEN RIGHT(market_cap, 1) = 'M' THEN CAST(REPLACE(LEFT(market_cap, LENGTH(market_cap) - 1), ',', '') AS NUMERIC) * 1e6
                         WHEN RIGHT(market_cap, 1) = 'T' THEN CAST(REPLACE(LEFT(market_cap, LENGTH(market_cap) - 1), ',', '') AS NUMERIC) * 1e12
                         ELSE CAST(REPLACE(market_cap, ',', '') AS NUMERIC)
                     END DESC) as rank
              FROM eod_stock_quotes
              WHERE symbol IN ({$symbolsList})
                AND market_cap IS NOT NULL
                AND market_cap != '-'
              ) as ranked";

        $eod_stocks = DB::table(DB::raw($subQuery))
            ->where('rank', 1)
            ->orderByRaw('CASE
                                  WHEN market_cap IS NULL THEN 0
                                  WHEN market_cap = \'-\' THEN 0
                                  WHEN RIGHT(market_cap, 1) = \'B\' THEN CAST(REPLACE(LEFT(market_cap, LENGTH(market_cap) - 1), \',\', \'\') AS NUMERIC) * 1e9
                                  WHEN RIGHT(market_cap, 1) = \'M\' THEN CAST(REPLACE(LEFT(market_cap, LENGTH(market_cap) - 1), \',\', \'\') AS NUMERIC) * 1e6
                                  WHEN RIGHT(market_cap, 1) = \'T\' THEN CAST(REPLACE(LEFT(market_cap, LENGTH(market_cap) - 1), \',\', \'\') AS NUMERIC) * 1e12
                                  ELSE CAST(REPLACE(market_cap, \',\', \'\') AS NUMERIC)
                              END DESC')
            ->limit($countSymbols)
            ->get()
            ->toArray();

        $eod_stocks_array = json_decode(json_encode($eod_stocks), true);
        $table_data = EOD_StockQuotes::prepareMarketData($eod_stocks_array);

        return $table_data;
    }

    /**
     * Change Volume Format
     */
    public static function getUpcomingEarnings($countSymbols)
    {
        $symbols = ActualSymbols::pluck('symbol')->toArray();
        $earnings = EarningsEstimate::select('earnings_estimate.*')
            ->fromSub(function ($query) use ($symbols) {
                $query->from('earnings_estimate')
                    ->whereIn('symbol', $symbols)
                    ->selectRaw('id, symbol, est_earnings_date, e_eps, e_rev, ROW_NUMBER() OVER (PARTITION BY symbol ORDER BY est_earnings_date ASC) as rn')
                    ->where('est_earnings_date', '>=', date('Y-m-d'))
                    ->where('est_earnings_date', '<=', date('Y-m-d', strtotime('+30 days')));
            }, 'earnings_estimate')
            ->where('rn', 1)
            ->orderBy('est_earnings_date', 'asc') // Сортировка результатов по est_earnings_date
            ->limit($countSymbols)
            ->get()
            ->toArray();

        $eod_stocks = DB::table('eod_stock_quotes')
            ->joinSub(
                DB::table('eod_stock_quotes')
                    ->select('symbol', DB::raw('MAX(date) as latest_date'))
                    ->whereIn('symbol', $symbols)
                    ->groupBy('symbol'),
                'latest_stocks',
                function ($join) {
                    $join->on('eod_stock_quotes.symbol', '=', 'latest_stocks.symbol')
                        ->on('eod_stock_quotes.date', '=', 'latest_stocks.latest_date');
                }
            )
            ->get()
            ->toArray();

        $eod_stocks_array = json_decode(json_encode($eod_stocks), true);
        $eod_stocks = EOD_StockQuotes::prepareMarketData($eod_stocks_array);

        return [$eod_stocks, $earnings];
    }

    /**
     * Get Highest Dividends Stocks
     */
    public static function getHighestDividendStocks($countSymbols)
    {
        $symbols = ActualSymbols::pluck('symbol')->toArray();
        $dividends = DividendStocks::whereIn('symbol', $symbols)->where('current_yield', '!=', 0)->orderBy('current_yield', 'desc')->limit($countSymbols)->get()->toArray();
        $dividendsData = DividendStocks::prepareDevidents($dividends);

        $symbols = EOD_OptionQuotes::getSymbolsFromRows($dividendsData);
        $lastRecords = EOD_StockQuotes::select('symbol', DB::raw('MAX(id) as last_id'))
            ->whereIn('symbol', $symbols)
            ->groupBy('symbol');

        $eod_stocks = EOD_StockQuotes::whereIn('id', function ($query) use ($lastRecords) {
            $query->select('last_id')->fromSub($lastRecords, 'sub');
        })->get()->toArray();
        $table_data = EOD_StockQuotes::prepareMarketData($eod_stocks);

        return [$table_data, $dividendsData];
    }

    /**
     * Get Highest Dividends Stocks
     */
    public static function getBestPerformingStocksYesterday($countSymbols)
    {
        // Prepare Variables
        $symbols = ActualSymbols::pluck('symbol')->toArray();
        $yesterday = date('Y-m-d', strtotime('-1 day'));

        // Get number day of the week
        $dayOfWeek = date('N', strtotime($yesterday));

        // If weekends - get last Friday
        if ($dayOfWeek == 6 || $dayOfWeek == 7) {
            $yesterday = date('Y-m-d', strtotime('last Friday'));
        }

        $eod_stocks = EOD_StockQuotes::whereIn('symbol', $symbols)->where('date', $yesterday)->orderBy('change_percent', 'desc')->limit($countSymbols)->get()->toArray();

        // Prepare Table Data
        $market_data = EOD_StockQuotes::prepareMarketData($eod_stocks);

        return [$yesterday, $market_data];
    }

    /**
     * Change Volume Format
     */
    public static function change_price_format($value)
    {
        // Удаление запятых для обработки числа
        $num = floatval(str_replace(',', '', $value));

        // Форматирование числа в зависимости от его величины
        if ($num >= 1000000000) {
            return number_format($num / 1000000000, 2, '.', '') . 'B';
        } else if ($num >= 1000000) {
            return number_format($num / 1000000, 2, '.', '') . 'M';
        } else if ($num >= 1000) {
            return number_format($num / 1000, 2, '.', '') . 'K';
        } else {
            return strval($num);
        }
    }
}
