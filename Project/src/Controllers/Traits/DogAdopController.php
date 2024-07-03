<?php
namespace App\Controllers\Traits;

use App\Lib\View;
use App\Models\AnimalsModel;

trait DogAdopController
{
    public function dogadop()
    {                
        $title = 'They are waiting for you'; 
        
        $get = [
            'b' => $_GET['b'] ?? '',
            'a' => $_GET['a'] ?? '',
            'g' => $_GET['g'] ?? '',
            's' => $_GET['s'] ?? '',
        ];

        $am = new AnimalsModel('animal_info');

        $am->setSearchKeyWords($get);

        $breeds = $am->getBreeds();
        
        $ages = $am->getAges();
        
        $dogs= $am->getListAnimalsRecords();
            
        View::loadView('dogadop', compact(
            'title', 'dogs', 'breeds', 'ages', 'get'
        ));        
    }
}