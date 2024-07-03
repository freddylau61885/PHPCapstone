<?php
namespace App\Controllers\Traits;

use App\Lib\View;

trait NewsController
{
    public function news()
    {        

        $title = 'News';

        View::loadView('news', compact('title'));        
    }
}
