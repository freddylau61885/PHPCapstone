<?php
namespace App\Controllers\Traits;

use App\Lib\View;

trait DogTrainController
{
    public function dogtrain()
    {        

        $title = 'Professional Trainers';

        View::loadView('dogtrain', compact('title'));        
    }
}