<?php
namespace App\Controllers\Admin\Traits;

use App\Lib\Utils;
use App\Classes\DatabaseLogger;
use App\Models\AnimalsModel;

trait DeleteRecordController
{
    public function deleterec()
    {
        $logger = new DatabaseLogger();        

        Utils::checkPageUsingPostMethod($logger); 
        Utils::checkAdminLoggedIn($logger);      
        
        $am = new AnimalsModel('animal_info');
        $row = $am->deleteRecordByAniID($_POST['id']);

        if($row){
            $_SESSION['success'] = "Record removed";
        }else{
            $_SESSION['error'] = "Unable to remove record";
        }

        // Redirect to list page
        header("Location: /aniinfo" );
        die();
    }
}