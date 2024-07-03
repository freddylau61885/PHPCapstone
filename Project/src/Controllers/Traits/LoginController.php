<?php
namespace App\Controllers\Traits;

use App\Models\UserModel;
use App\Lib\{View, Utils};
use App\Classes\{Validator, FileLogger,DatabaseLogger};

trait LoginController
{
    public function login()
    {        

        $title='User Login';
        if(isset($_SESSION['user'])){
            $_SESSION['info'] = "You are already logged in.";
            header('Location: user_profile');
            die;
        }
        
        $errors = [];
        //validation array
        $validate_map = [    
            'email' => ['validateEmail', 'checkEmailregistered'],
            'password' => ['validatePassword', 'comparePassword']
        ];
        
        $logger = new DatabaseLogger();

        if ('POST' == $_SERVER['REQUEST_METHOD']) {
                          
            Utils::checkCSRFToken();
            
            $um = new UserModel('users');  
            $v = new Validator($_POST);
            $user = $um->getIsActiveUserByEmail($_POST['email'])[0] ?? [];
            //set user to validation object
            $v->setUser($user);
            $v->validate($validate_map);        
            $errors = $v->errors();
                    
            if (count($errors) == 0) { 
                //Use Database Logger
                $event = Utils::createLogEvent('INFO', 
                "Login User: {$_POST['email']}");    
                Utils::logEvent($logger, $event);

                $_SESSION['success'] = "Welcome back, {$user['login_id']}!";                    
                Utils::login(
                    $user['id'], $user['login_id'], $user['is_admin'], 0
                );
            }
        
            $_SESSION['error'] = 'Login Failure!';  
                     
            $event = Utils::createLogEvent('INFO', $_SESSION['error']);    
            Utils::logEvent($logger, $event);
        }else{                    
            $event = Utils::createLogEvent('ERROR', 
            "Unsupport request method: {$_SERVER['REQUEST_METHOD']}");    
            Utils::logEvent($logger, $event);
        }

        View::loadView('login', compact('title'));        
    }
}
