<?php
namespace App\Controllers\Traits;

use App\Lib\Utils;
use App\Classes\{FileLogger,DatabaseLogger};

trait LogoutController
{
    public function logout()
    {        

        //Use Database Logger
        $logger = new DatabaseLogger();
        Utils::checkUserLoggedin($logger);
                
        $event = Utils::createLogEvent('INFO', 
        "Logout User id: {$_SESSION['user']['id']}");    
        Utils::logEvent($logger, $event);

        Utils::logout();      
    }
}



