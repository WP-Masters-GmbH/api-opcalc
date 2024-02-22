<?php

namespace App\Collections;

class OptionChainsCollection
{
    public function __construct(
        public string $dte,
        public string $expiration,
        public string $putCall,
        public ?int $volume,
        public ?int $openInt,
        public ?float $strike,
        public ?float $price,
        public string $optionRange,
        public string $underlying
    ) {
    }
}
