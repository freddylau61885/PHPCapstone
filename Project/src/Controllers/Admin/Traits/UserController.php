<?php
namespace App\Controllers\Admin\Traits;

use App\Classes\{DatabaseLogger,FileLogger};
use App\Models\UserModel;
use App\Lib\{View, Utils};

trait UserController
{
    public function users()
    {
        $logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);
        //Use Database Logger                
        Utils::checkAdminLoggedIn($logger);

        $get = [            
            's' => $_GET['s'] ?? ''
        ];

        $page = Utils::getCurrentPage();

        $title = 'Users';

        $um = new UserModel('users');

        $um->setSearchKeyWords($get);

        $data= $um->getAllUsers();        

        View::loadView('/Admin/admin_tables', compact('title','data', 'page'));
    }
}