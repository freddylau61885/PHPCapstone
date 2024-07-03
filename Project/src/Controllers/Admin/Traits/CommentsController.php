<?php
namespace App\Controllers\Admin\Traits;

use App\Classes\{DatabaseLogger,FileLogger};
use App\Models\CommentsModel;
use App\Lib\{View, Utils};

trait CommentsController
{
    public function comments()
    {
        $logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);
        //Use Database Logger                
        Utils::checkAdminLoggedIn($logger);

        $get = [            
            's' => $_GET['s'] ?? ''
        ];

        $page = Utils::getCurrentPage();

        $title = 'Comments';

        $cm = new CommentsModel('user_comments');

        $cm->setSearchKeyWords($get);

        $data= $cm->getAllComments();        

        View::loadView('/Admin/admin_tables', compact('title','data', 'page'));
    }
}