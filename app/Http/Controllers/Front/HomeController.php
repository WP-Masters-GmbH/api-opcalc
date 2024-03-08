<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Commands\PagesFunctions\HomeFunctions;

class HomeController extends Controller
{
    public function __invoke()
    {
        [$HighestIVTableData, $HighestIVTableStocks, $HighestIVTableEarningsEstimates] = HomeFunctions::getHighestIVRows(10);
        $MarketCapTableData = HomeFunctions::getHighestMarketCapRows(10);
        [$EODStocks, $UpcomingEarnings] = HomeFunctions::getUpcomingEarnings(10);
        [$HighestDividendTableData, $HighestDividends] = HomeFunctions::getHighestDividendStocks(10);
        [$yesterday, $BestPerformingStocksMarketData] = HomeFunctions::getBestPerformingStocksYesterday(10);


        $title = 'Home Page';
        return view('pages.front.home', compact(
            'title',
            'HighestIVTableData',
            'HighestIVTableStocks',
            'HighestIVTableEarningsEstimates',
            'MarketCapTableData',
            'EODStocks',
            'UpcomingEarnings',
            'HighestDividendTableData',
            'HighestDividends',
            'BestPerformingStocksMarketData'
        ));
    }
}
