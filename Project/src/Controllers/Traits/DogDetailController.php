<?php
namespace App\Controllers\Traits;

use App\Lib\{View, Utils};
use App\Models\AnimalsModel;
use App\Classes\{Validator, FileLogger,DatabaseLogger};
use App\Models\CommentsModel;

trait DogDetailController
{
    public function dogdetail()
    {        
        
        $id = $_GET['id'] ?? 0;

        if(!$id){
            $_SESSION['error'] = "Please select an animal";
            header('Location: /dogadop');
            die;
        }

        $title = 'Dog Details';

        $am = new AnimalsModel('animal_info'); 
        
        $cm = new CommentsModel('user_comments');
        
        $dog_view_array = [];
        $imgs = [];
        $comments = [];

        $dog = $am->getOneRecord($id);
        
        if(!$dog['ani_id']){ 
            $_SESSION['error'] = 'No record found';    
            header('Location: /dogadop');       
            die;
        }

        $dog_view_array = [];

        $logger = new DatabaseLogger();

        if ('POST' == $_SERVER['REQUEST_METHOD']) {
                          
            Utils::checkCSRFToken();
            
            $_POST['user_id'] = $_SESSION['user']['id'];
            $_POST['ani_id'] = $id;
            
            $v = new Validator($_POST);
            $validate_map = [    
                'comment' => []
            ];
            $v->validate($validate_map);

            $errors = $v->errors();
                    
            if (count($errors) == 0) { 
                //Use Database Logger
                $event = Utils::createLogEvent('INFO', 
                "user {$_SESSION['user']['name']} left a comment ");    
                Utils::logEvent($logger, $event);
                $cm->setPostData($_POST);

                //insert comment to database
                $success = $cm->writeComment();
                if(!$success){
                    $_SESSION['error'] = "Unable to leave comment.";
                }else{
                    $_SESSION['success'] = "Leave comment Successfully!";
                }
                header("Location: /dogdetails?id=$id");
                die;
            }
                    
            $_SESSION['error'] = $errors['comment'][0];  
                     
            $event = Utils::createLogEvent('INFO', $_SESSION['error'][0]);    
            Utils::logEvent($logger, $event);
        }else{                    
            $event = Utils::createLogEvent('ERROR', 
            "Unsupport request method: {$_SERVER['REQUEST_METHOD']}");    
            Utils::logEvent($logger, $event);
        }

        
        //dog detail data massage
        foreach ($dog as $key => $value){

            switch ($key) {
                case ($key == 'is_active' || $key == 'created_at' || 
                      $key == 'updated_at' || $key == 'thumbnail_path'):
                    break;
                case 'ani_id':
                    $dog_view_array['ID'] = $value;
                    break;
                case 'dob':
                    $dog_view_array['DOB'] = $value;
                    break;
                case ($key == 'has_chip' || $key == 'neutered'):
                    $dog_view_array[ucfirst(str_replace("_"," ",$key))] = 
                    $value? 'Yes' : 'No';
                    break;
                default:
                    $dog_view_array[ucfirst($key)] = $value;
            }            
        }        

        $imgs = $am->getAnimalImages($id);   
        
        $comments = $cm->getAnimalComments($id);
        

        View::loadView('dogdetails', compact(
            'title', 'dog_view_array', 'imgs', 'comments'
        ));        
    }
}