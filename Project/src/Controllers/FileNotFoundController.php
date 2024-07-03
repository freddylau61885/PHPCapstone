<?php
namespace App\Controllers;

use App\Lib\View;

class FileNotFoundController
{
    public function fileNotFound()
    {
        http_response_code(404);

        $title = '404 - Not Found';

        View::loadView('404', compact('title'));        
    }
}

