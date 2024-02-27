<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MarketDataController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FinancialToolsController;
use App\Http\Controllers\ajaxController;
use App\Http\Controllers\formController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#Route::get('/', [PagesController::class, 'index']);

// Main Pages
Route::get('/', HomeController::class);
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/market-data', [MarketDataController::class, 'index'])->name('market-data');
Route::get('/option-pinning-strategy', [PagesController::class, 'optionPinningStrategy'])->name('option-pinning-strategy');

// Free financial tools
Route::get('/financial-tools/dollar-cost-averaging-calculator', [FinancialToolsController::class, 'dollarCostAveragingCalculator'])->name('dollar-cost-averaging-calculator');
Route::get('/financial-tools/earnings-simulator', [FinancialToolsController::class, 'earningsSimulator'])->name('earnings-simulator');

// Options Data
Route::get('/market-data/highest-iv-options', [MarketDataController::class, 'highestIVOptions'])->name('highest-iv-options');
Route::get('/market-data/highest-volume-options', [MarketDataController::class, 'highestVolumeOptions'])->name('highest-volume-options');
Route::get('/market-data/lowest-iv-options', [MarketDataController::class, 'lowestIVOptions'])->name('lowest-iv-options');
Route::get('/market-data/lowest-volume-options', [MarketDataController::class, 'lowestVolumeOptions'])->name('lowest-volume-options');
Route::get('/{symbol}/eod-option-chains/{date}', [MarketDataController::class, 'eodOptionChains'])->name('eod-option-chains');
Route::get('/market-data/all-usa-stocks', [MarketDataController::class, 'allUsaStocks'])->name('all-usa-stocks');

// Stocks Data
Route::get('/market-data/stocks/stocks-by-market-cap', [MarketDataController::class, 'stockByMarketCap'])->name('stocks-by-market-cap');
Route::get('/market-data/stocks/highest-beta-stocks', [MarketDataController::class, 'highestBetaStocks'])->name('highest-beta-stocks');
Route::get('/market-data/stocks/lowest-beta-stocks', [MarketDataController::class, 'lowestBetaStocks'])->name('lowest-beta-stocks');
Route::get('/market-data/stocks/eod-stock-prices/{symbol}', [MarketDataController::class, 'eodStockPrices'])->name('eod-stock-prices');

// Dividend Data
Route::get('/market-data/dividends/{symbol}/dividend-history', [MarketDataController::class, 'dividendHistory'])->name('dividend-history');
Route::get('/market-data/dividends/highest-dividend-yield-stocks', [MarketDataController::class, 'highestDividendYieldStocks'])->name('highest-dividend-yield-stocks');
Route::get('/market-data/dividends/upcoming-ex-dividend-dates', [MarketDataController::class, 'upcomingExDividendDates'])->name('upcoming-ex-dividend-dates');
Route::get('/market-data/dividends/monthly-dividend-stocks', [MarketDataController::class, 'monthlyDividendStocks'])->name('monthly-dividend-stocks');

// Ratings & Analysts predictions
Route::get('/market-data/ratings/{symbol}', [MarketDataController::class, 'ratingAnalystsPrediction'])->name('rating-analysts-prediction');

// Option Chain
Route::get('/market-data/option-chains', [MarketDataController::class, 'optionChainSearch'])->name('option-chain-search');
Route::get(
    '/market-data/option-chains/{symbol}/{date?}',
    [MarketDataController::class, 'optionChainSymbol']
)->name('option-chain-symbol');

// Ajax Routes
Route::post('/ajax/dca_calculation', [ajaxController::class, 'dcaCalculation']);

// Form Routes
Route::post('/form/search_chain_symbol', [formController::class, 'searchChainSymbol'])->name('search-chain-symbol');
;
