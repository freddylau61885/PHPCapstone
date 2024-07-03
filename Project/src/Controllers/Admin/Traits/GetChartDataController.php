<?php
namespace App\Controllers\Admin\Traits;

use App\Lib\Utils;
use App\Classes\DatabaseLogger;
use App\Models\{AnimalsModel,AdoptionsModel,UserModel};

trait GetChartDataController
{
    public function getChartData()
    {
        $logger = new DatabaseLogger();        

        Utils::checkPageUsingPostMethod($logger); 
        Utils::checkAdminLoggedIn($logger);      
        
        $am = new AnimalsModel('animal_info');
        $adm = new AdoptionsModel('addoptions');
        $um = new UserModel('users');        

        $breeds = $am->getAllQuantityByBreed();
        $breeds_chart = [];
        foreach($breeds as $row){
            $breeds_chart[] = [
                'value' => $row['total'],
                'name' => $row['breed']
            ];
        };   

        $ages = $am->getAllQuantityByAge();
        $age_chart = [];
        foreach($ages as $row){
            $age_chart[] = [
                'value' => $row['total'],
                'name' => $row['age'] . ' year-old'
            ];
        };

        $status = $adm->getAllQuantityByStatus();
        $status_chart = [];
        foreach($status as $row){
            $status_chart[] = [
                'value' => $row['total'],
                'name' => $row['status']
            ];
        };

        $subscribers = $um->getTotalSubscriber();
        $subscribers_chart = [];
        foreach($subscribers as $row){
            $subscribers_chart[] = [
                'value' => $row['total'],
                'name' => $row['users']
            ];
        };

        $data = [
            'breeds' => $breeds_chart,
            'ages' => $age_chart,
            'status' => $status_chart,
            'users' => $subscribers_chart
        ];

        echo json_encode($data);
    }
}