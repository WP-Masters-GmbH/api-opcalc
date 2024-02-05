<?php

namespace App\View\Components\Front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public array $menuItems;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menuItems = [
            [
                'title' => 'Home',
                'link' => '/'
            ],
            [
                'title' => 'Calculator',
                'link' => '/calculator'
            ],
            [
                'title' => 'Market data',
                'link' => '/market-data'
            ],
            [
                'title' => 'Education',
                'link' => '/education'
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.header');
    }
}
