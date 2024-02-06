<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EOD_OptionQuotes extends Model
{
    use HasFactory;

    protected $table = 'eod_option_quotes';

    /**
     * Prepare Data for IV Table
     */
    public static function prepareLowestIVTable($rows)
    {
        $symbols = [];
        foreach($rows as $row) {
            if(isset($symbols[$row['symbol']]['volatility']) && $row['volatility'] < $symbols[$row['symbol']]['volatility']) {
                $symbols[$row['symbol']] = $row;
            } elseif(!isset($symbols[$row['symbol']]['volatility']) && $row['volatility'] > 0) {
                $symbols[$row['symbol']] = $row;
            }
        }

        return $symbols;
    }

    /**
     * Prepare Data for IV Table
     */
    public static function prepareHighestIVTable($rows)
    {
        $symbols = [];
        foreach($rows as $row) {
            if(isset($symbols[$row['symbol']]['volatility']) && $row['volatility'] > $symbols[$row['symbol']]['volatility']) {
                $symbols[$row['symbol']] = $row;
            } elseif(!isset($symbols[$row['symbol']]['volatility']) && $row['volatility'] > 0) {
                $symbols[$row['symbol']] = $row;
            }
        }

        return $symbols;
    }

    /**
     * Prepare Data for Volume Table
     */
    public static function prepareHighestVolumeTable($rows)
    {
        $symbols = [];
        foreach($rows as $row) {
            if(isset($symbols[$row['symbol']]['volume']) && $row['volume'] > $symbols[$row['symbol']]['volume']) {
                $symbols[$row['symbol']] = $row;
            } elseif(!isset($symbols[$row['symbol']]['volume']) && $row['volume'] > 0) {
                $symbols[$row['symbol']] = $row;
            }
        }

        return $symbols;
    }

    /**
     * Prepare Data for Volume Table
     */
    public static function prepareLowestVolumeTable($rows)
    {
        $symbols = [];
        foreach($rows as $row) {
            if(isset($symbols[$row['symbol']]['volume']) && $row['volume'] > 0 && $row['volume'] < $symbols[$row['symbol']]['volume']) {
                $symbols[$row['symbol']] = $row;
            } elseif(!isset($symbols[$row['symbol']]) && $row['volume'] > 0) {
                $symbols[$row['symbol']] = $row;
            }
        }

        return $symbols;
    }
}
