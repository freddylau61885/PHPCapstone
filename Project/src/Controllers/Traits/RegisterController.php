<?php
namespace App\Controllers\Traits;

use App\Models\UserModel;
use App\Classes\{Validator, FileLogger,DatabaseLogger};
use App\Lib\{View, Utils};

trait RegisterController
{
    public function register()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['info'] = "Please log out to registrate another user.";
            header('Location: user_profile');
            die;
        }

        $title = 'Registration';        

        $errors = [];

        //Validation array
        $validate_map = [
            'first_name' => ['validateName'],
            'last_name' => ['validateName'],
            'street' => ['validateStreet'],
            'city' => ['validateCity'],
            'postal_code' => ['validatePostalCode'],
            'province' => ['validateProvinceAndCountry'],
            'country' => ['validateProvinceAndCountry'],
            'phone' => ['validatePhone'],
            'email' => ['validateEmail', 'isEmailExist'],
            'login_id' => ['validateLoginId'],
            'password' => ['validatePassword'],
            'confirm_password' => ['isPasswordMatch']
        ];

        $logger = new DatabaseLogger();
        // $errors = [];

        if ('POST' == $_SERVER['REQUEST_METHOD']) {

            Utils::checkCSRFToken();

            $v = new Validator($_POST);
            $v->validate($validate_map);
            $errors = $v->errors();            

            if (count($errors) == 0) {                
                $um = new UserModel('users');
                //return id or return 0 if unsuccessful
                $id = $um->insertUserAndReturnLastID($_POST);

                if (!$id) {
                    die('User insert unsucessful');
                }

                $_SESSION['register'] = 1;
                $_SESSION['success'] = 'Thank you for registering!';
                Utils::login($id, $_POST['login_id'], 0, 1);
                //Use Database Logger
                
                $event = Utils::createLogEvent('INFO', 
                "Register User: {$_POST['email']}");    
                Utils::logEvent($logger, $event);
            }
        }else{
            $event = Utils::createLogEvent('ERROR', 
            "Unsupport request method: {$_SERVER['REQUEST_METHOD']}");    
            Utils::logEvent($logger, $event);
        }

        View::loadView('register', compact('title', 'errors'));
    }
}
