<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EOD_StockQuotes extends Model
{
    use HasFactory;

    protected $table = 'eod_stock_quotes';

    /**
     * prepare Data for Beta Stocks Table
     */
    public static function prepareMarketData($rows)
    {
        // Prepare Symbols Data
        $symbols = [];
        foreach($rows as $row) {
            $symbols[$row['symbol']][$row['date']] = $row;

            uksort($symbols[$row['symbol']], function($a, $b) {
                return -strcmp($a, $b);
            });
        }


        $final_data = [];
        foreach($symbols as $symbol => $symbol_data) {
            $final_data[$symbol] = end($symbol_data);
        }

        return $final_data;
    }
}
