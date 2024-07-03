<?php
namespace App\Controllers\Traits;

use App\Lib\View;

trait HomeController
{
    public function home()
    {        

        $title = 'Home';

        View::loadView('index', compact('title'));        
    }
}

