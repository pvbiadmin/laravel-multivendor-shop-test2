<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $product;
    public $section;
    public $key;

    /**
     * Create a new component instance.
     */
    public function __construct($product, $section = 'productPage', $key = NULL)
    {
        $this->product = $product;
        $this->section = $section;
        $this->key = $key;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
