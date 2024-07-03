<?php
namespace App\Controllers\Traits;

use App\Models\{AdoptionsModel, UserModel, CommentsModel};
use App\Classes\DatabaseLogger;
use App\Lib\{View, Utils};

trait UserProfileController
{
    public function userprofile()
    {
        //Use Database Logger
        $logger = new DatabaseLogger();  
        Utils::checkUserLoggedin($logger);

        $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
        //check user register or just login
        $register = isset($_SESSION['register']) ? $_SESSION['register'] : 0;
        
        $um = new UserModel('users');
        $cm = new CommentsModel('user_comments');
        $am = new AdoptionsModel('adoptions');

        //init page information
        $user = $um->getUser($id);
        $comments = $cm->getUserComments($id);
        $adoptions = $am->getUserAdoptionRecords($id);

        if (!$user) {
            $msg = 'User not found';
            
            $event = Utils::createLogEvent('INFO', "Register User: $msg");    
            Utils::logEvent($logger, $event);

            $_SESSION['error'] = $msg;
            unset($_SESSION['user']);
            header('Location: login');
            die;
        }

        $title = 'User Profile';

        //show different sentence between register and login
        if ($register) {
            $first_p = 'You submitted the following information:';
        } else {
            $first_p = 'The following are your information:';
        }

        View::loadView('user_profile', compact(
            'title', 'first_p', 'user', 'comments', 'adoptions'
        ));      
    }
}
