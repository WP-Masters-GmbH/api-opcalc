<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    /**
     * Get class for Chart to show correct color
     */
    public static function getGraphColor($consensus)
    {
        if($consensus == 'Sell') {
            $color = 'red';
        } elseif($consensus == 'Reduce') {
            $color = 'orange';
        } elseif($consensus == 'Hold') {
            $color = 'yellow';
        } elseif($consensus == 'Moderate Buy') {
            $color = 'light-green';
        } elseif($consensus == 'Buy') {
            $color = 'green';
        } else {
            $color = 'red';
        }

        return $color;
    }

    /**
     * Get correct Percent for Upside percent
     */
    public static function getUpsideColor($price, $eod_price)
    {
        $percent = ($price - $eod_price) / $eod_price;

        return round($percent * 100, 2);
    }
}
