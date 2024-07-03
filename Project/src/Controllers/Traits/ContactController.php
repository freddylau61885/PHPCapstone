<?php
namespace App\Controllers\Traits;

use App\Lib\View;

trait ContactController
{
    public function contact()
    {        

        $title = 'Inquiry Form';

        View::loadView('contact', compact('title'));        
    }
}
