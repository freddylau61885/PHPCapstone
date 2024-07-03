<?php
namespace App\Controllers\Admin\Traits;

use App\Classes\{DatabaseLogger,FileLogger};
use App\Models\AnimalVaccinationModel;
use App\Lib\{View, Utils};

trait VaccinesController
{
    public function ani_vac()
    {
        $logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);
        //Use Database Logger                
        Utils::checkAdminLoggedIn($logger);

        $get = [            
            's' => $_GET['s'] ?? ''
        ];

        $page = Utils::getCurrentPage();

        $title = 'Animal Vaccines';

        $am = new AnimalVaccinationModel('animal_vaccination');

        $am->setSearchKeyWords($get);

        $data= $am->getAllVaccines();        

        View::loadView('/Admin/admin_tables', compact('title','data', 'page'));
    }
}