<?php

namespace App\View\Components\Frontend;

use App\Models\Page;
use Illuminate\View\Component;
use Illuminate\View\View;

class Navbar extends Component
{
    public $pages;
    public $brandName;
    public $brandDescription;

    public function __construct()
    {
        // 1. Fetch dynamic pages
        $this->pages = Page::query()
            ->select('id', 'title', 'slug')
            ->where('is_visible_in_nav', true)
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get();            

        // 2. Define your brand variables (Zero DB queries)
        $this->brandName = config('app.name', 'Lusweti');
        $this->brandDescription = 'Your trusted source for news, dynamic content updates, and editorial articles.';
    }

    public function render(): View
    {
        return view('components.frontend.navbar');
    }
}

// namespace App\View\Components\Frontend;

// use App\Models\Page;
// use Illuminate\View\Component;
// use Illuminate\View\View;

// class Navbar extends Component
// {
//     // By making this public, it becomes automatically available in your Blade view as $pages
//     public $pages;

//     public function __construct()
//     {
//         // Fetch the data here
//         $this->pages = Page::query()
//             ->select('id', 'title', 'slug')
//             ->where('is_visible_in_nav', true)
//             ->where('status', 'published')
//             ->orderBy('sort_order')
//             ->get();            
//     }

//     public function render(): View
//     {
//         return view('components.frontend.navbar');
//     }
// }