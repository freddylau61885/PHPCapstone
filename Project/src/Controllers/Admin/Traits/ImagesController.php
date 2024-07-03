<?php
namespace App\Controllers\Admin\Traits;

use App\Classes\{DatabaseLogger,FileLogger};
use App\Models\AnimalImgModel;
use App\Lib\{View, Utils};

trait ImagesController
{
    public function ani_imgs()
    {
        $logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);
        //Use Database Logger                
        Utils::checkAdminLoggedIn($logger);
        
        $get = [            
            's' => $_GET['s'] ?? ''
        ];

        $page = Utils::getCurrentPage();

        $title = 'Animal Images';

        $am = new AnimalImgModel('animal_img');

        $am->setSearchKeyWords($get);

        $data= $am->getAllImages();        

        View::loadView('/Admin/admin_tables', compact('title','data', 'page'));
    }
}