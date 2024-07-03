<?php
namespace App\Controllers\Admin\Traits;

use App\Classes\{DatabaseLogger,FileLogger};
use App\Models\AnimalInfoVaccinationModel;
use App\Lib\{View, Utils};

trait AniVacInfoController
{
    public function ani_vac_info()
    {
        $logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);
        //Use Database Logger                
        Utils::checkAdminLoggedIn($logger);

        $get = [            
            's' => $_GET['s'] ?? ''
        ];

        $page = Utils::getCurrentPage();

        $title = 'Vaccination Information';

        $am = new AnimalInfoVaccinationModel('animal_info_vaccination');

        $am->setSearchKeyWords($get);

        $data= $am->getAllAniVacInfo();        

        View::loadView('/Admin/admin_tables', compact('title','data', 'page'));
    }
}