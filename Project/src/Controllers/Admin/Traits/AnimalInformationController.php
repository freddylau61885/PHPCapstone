<?php
namespace App\Controllers\Admin\Traits;

use App\Classes\{DatabaseLogger,FileLogger};
use App\Models\AnimalsModel;
use App\Lib\{View, Utils};

trait AnimalInformationController
{
    public function aniinfo()
    {
        $logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);
        //Use Database Logger                
        Utils::checkAdminLoggedIn($logger);

        $get = [
            'b' => $_GET['b'] ?? '',
            'a' => $_GET['a'] ?? '',
            'g' => $_GET['g'] ?? '',
            's' => $_GET['s'] ?? '',
        ];        
    
        $page = Utils::getCurrentPage();        

        $title = 'Animal Information';

        $am = new AnimalsModel('animal_info');

        $am->setSearchKeyWords($get);
        
        $data= $am->getAllAnimalsInAdmin();           

        View::loadView('/Admin/admin_tables', compact('title','data', 'page'));
    }
}