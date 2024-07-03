<?php
namespace App\Controllers\Admin\Traits;

use App\Classes\{DatabaseLogger,FileLogger};
use App\Lib\{View, Utils};
use App\Models\{AnimalsModel,AdoptionsModel,UserModel};

trait DashboardController
{
    public function index()
    {
        $logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);
        //Use Database Logger                
        Utils::checkAdminLoggedIn($logger);

        $title = 'Dashboard';   
        $ani = [];
        $adopt = [];
        $users = [];
        $am = new AnimalsModel('animal_info');
        $adm = new AdoptionsModel('addoptions');
        $um = new UserModel('users');
        
        //Get all data from animal_info table
        $ani['total'] = $am->getTotalAnimal()['total'];
        $mxmiavg = $am->getMaxMinAndAvgAge();
        if($mxmiavg){
            foreach($mxmiavg as $key => $value){
                $ani[$key] = $value;
            }
        }           
              
        //Get all data from adoptions table
        $adopt['total'] = $adm->getTotalAdoption()['total'];
        

        //Get all data from users table
        $users['total'] = $um->getTotalUsers()['total'];        
        
        //Get all logs from log table
        $logs = $logger->read(); 

        $data = [
            'ani' => $ani,
            'adopt' => $adopt,
            'users' => $users
        ];

        View::loadView('/Admin/admin', compact('title','logs', 'data'));        
    }
}
