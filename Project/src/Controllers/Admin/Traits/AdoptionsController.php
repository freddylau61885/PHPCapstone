<?php
namespace App\Controllers\Admin\Traits;

use App\Classes\{DatabaseLogger,FileLogger};
use App\Models\AdoptionsModel;
use App\Lib\{View, Utils};

trait AdoptionsController
{
    public function adops()
    {
        $logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);
        //Use Database Logger                
        Utils::checkAdminLoggedIn($logger);

        $get = [            
            's' => $_GET['s'] ?? ''
        ];

        $page = Utils::getCurrentPage();

        $title = 'Adoptions';

        $am = new AdoptionsModel('adoptions');

        $am->setSearchKeyWords($get);

        $data= $am->getAllAdoptionsInAdmin();              

        View::loadView('/Admin/admin_tables', compact('title', 'data', 'page'));
    }
}