<?php
namespace App\Controllers\Admin\Traits;

use App\Lib\Utils;
use App\Classes\DatabaseLogger;
use App\Models\AnimalImgModel;

trait DeleteImageController
{
    public function deleteimg()
    {
        $logger = new DatabaseLogger();
        //get json data post from JS
        $postdata = file_get_contents("php://input",'r');

        Utils::checkPageUsingPostMethod($logger);
        Utils::checkAdminLoggedIn($logger);
        $post = json_decode($postdata, true);
        
        $aim = new AnimalImgModel('animal_img');
        $row = $aim->deleteImgByID($post['img_id']);

        echo $row;
    }
}