<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DividendStocks extends Model
{
    use HasFactory;

    protected $table = 'dividend_stocks';

    /**
     * prepare Data for Beta Stocks Table
     */
    public static function prepareDevidents($rows)
    {
        // Prepare Symbols Data
        $symbols = [];
        foreach($rows as $row) {
            $symbols[$row['symbol']] = $row;
        }

        return $symbols;
    }
}
