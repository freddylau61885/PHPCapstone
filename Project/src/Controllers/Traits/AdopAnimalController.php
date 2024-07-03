<?php
namespace App\Controllers\Traits;

use App\Lib\Utils;
use App\Classes\DatabaseLogger;
use App\Models\AdoptionsModel;

trait AdopAnimalController
{

    public function adopanimal()
    {
        $logger = new DatabaseLogger();
        $postdata = file_get_contents("php://input",'r');

        Utils::checkPageUsingPostMethod($logger);
                
        Utils::checkUserLoggedin($logger);

        $post = json_decode($postdata, true);
        $post['user_id'] = $_SESSION['user']['id'];

        $ac = new AdoptionsModel('adoptions');
        $ac->setPostData($post);

        $exist = $ac->checkApplicationExist();
        $last_id = 0;

        if(!$exist){
            $_SESSION['success'] = "Apply for addoption successfully!";  
            $last_id = $ac->createTransaction();  
            $event = Utils::createLogEvent('INFO', 
            "user {$_SESSION['user']['name']} applied to adop 
            ani_id:{$post['ani_id']}");    
            Utils::logEvent($logger, $event);        
        }else{
            $_SESSION['error'] = "You already applied for adopt this animal";
        }

        echo $last_id;
    }

}