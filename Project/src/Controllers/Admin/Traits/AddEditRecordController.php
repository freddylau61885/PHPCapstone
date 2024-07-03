<?php

namespace App\Controllers\Admin\Traits;

use App\Classes\{DatabaseLogger, FileLogger, Validator};
use App\Lib\{View, Utils};
use App\Models\{
    AnimalsModel, 
    AnimalImgModel, 
    AnimalVaccinationModel, 
    AnimalInfoVaccinationModel
};

trait AddEditRecordController
{
    public function add_edit()
    {
        $logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);
        //Use Database Logger                
        Utils::checkAdminLoggedIn($logger);

        $id = isset($_GET['id']) ? $_GET['id'] : ''; 
        $title = "Add New Animal";
        $am = new AnimalsModel('animal_info');
        $aim = new AnimalImgModel('animal_img');
        $avm = new AnimalVaccinationModel('animal_vaccination');
        $aivm = new AnimalInfoVaccinationModel('animal_info_vaccination');

        $record = [];
        $img_record = [];
        $vac_record = [];
        $errors = [];

        //array for validation
        $validate_map = [
            'name' => ['validateName'],            
            'dob' => ['validateDateFormat'],
            'weight' => ['validateWeightAndHeight'],
            'height' => ['validateWeightAndHeight'],
            'breed' => ['validateName'],            
            'behaviors' => ['validateName'],
            'health' => ['validateName'],
            'description' => ['checkDescriptionlength']        
        ];

        if('POST' == $_SERVER['REQUEST_METHOD']){
            Utils::checkCSRFToken();           

            $v = new Validator($_POST);            
            $v->validate($validate_map);
            //check thumbnail uploaded
            $file_name = $_FILES['thumbnail_path']['name'];
            if($file_name){
                $v->checkUploadedfileisimage(
                    $_FILES['thumbnail_path']['tmp_name'], 'thumbnail_path'
                );
            }
            //check other images uploaded
            $imgs_exist = $_FILES['images']['name'][0];
            if($imgs_exist){
                foreach($_FILES['images']['tmp_name'] as $tmp_name){
                    $v->checkUploadedfileisimage($tmp_name, 'images');
                }
            }
            $errors = $v->errors();            

            if (count($errors) == 0) { 
                unset($_POST['csrf']); 
                $is_success = false;
                
                //if the page $id existed update database 
                if($id){
                    $is_success = $am->updateRecordByAniID(
                        $id, $_POST, $_FILES);
                //otherwise insert record to database
                }else{
                    $is_success = $am->insertRecordByAniID($_POST, $_FILES);
                }
                
                $new_file_path = __DIR__ . '/../../../../public/images/dogs/';                

                //If user uploaded thumbnail picture move thumbnail image
                if($file_name && $is_success){
                    move_uploaded_file(
                        $_FILES['thumbnail_path']['tmp_name'], 
                        $new_file_path . $file_name);                    
                }  

                //If user uploaded multiple images move images
                if($imgs_exist && $is_success){
                    for ($i = 0; $i < count($_FILES['images']['name']); $i++){
                        move_uploaded_file($_FILES['images']['tmp_name'][$i], 
                                           $new_file_path . 
                                           $_FILES['images']['name'][$i]);
                    }
                }

                if($is_success){
                    $_SESSION['success'] = "Record Saved";
                }else{
                    $_SESSION['error'] = "Save Record Failure";
                }

                // Redirect to list page
                header("Location: /aniinfo" );
                die();
            }            

        }                      
        
        //init the page record 
        if ($id) {
            $record = $am->getOneRecordByAniId($id);
            $img_record = $aim->getAllRecordsByAniID($id);
            $vac_record = $aivm->getAllRecordsByAniID($id);
            $title = "Edit Animal";            
            if(!$record){
                $_SESSION['error'] = 'No record found';    
                header('Location: /aniinfo');       
                die;
            }
        }
        $vaccines = $avm->getAllVaccines();
        $headers_array = $am->getfields();

        $headers_remove = [
            'ani_id',
            'is_active',
            'created_at',
            'updated_at'
        ];

        //unset specific array fields
        $headers = array_diff($headers_array, $headers_remove);

        //group all information then pass to view
        $data = [
            'title' => $title,
            'headers' => $headers,
            'vaccines' => $vaccines,
            'record' => $record,
            'img_record' => $img_record,
            'vac_record' => $vac_record
        ];
        

        View::loadView('/Admin/add_edit', compact(
            'title', 'data', 'id', 'errors'
        ));
    }
}
