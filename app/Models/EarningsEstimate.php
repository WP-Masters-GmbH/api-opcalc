<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EarningsEstimate extends Model
{
    use HasFactory;

    protected $table = 'earnings_estimate';

    /**
     * prepare Data for Beta Stocks Table
     */
    public static function prepareMarketData($rows)
    {
        // Prepare Symbols Data
        $symbols = [];
        foreach($rows as $row) {
            $symbols[$row['symbol']] = $row;
        }

        return $symbols;
    }
}
