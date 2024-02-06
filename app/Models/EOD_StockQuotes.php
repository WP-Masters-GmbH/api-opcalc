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
            if(isset($symbols[$row['symbol']]['date']) && strtotime($symbols[$row['symbol']]['date']) < strtotime($row['date'])) {
                $symbols[$row['symbol']] = $row;
            } elseif(!isset($symbols[$row['symbol']]['date'])) {
                $symbols[$row['symbol']] = $row;
            }
        }

        return $symbols;
    }
}
