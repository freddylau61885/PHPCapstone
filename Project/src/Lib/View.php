<?php 

namespace App\Lib;

class View
{
    static public function loadView($viewfileprefix, $getdata = [])
    {        
        //extract variables from Get Data
        extract($getdata);

        //concatenate full view file path
        $viewfolderpath = __DIR__ . '/../views/';
        $file = $viewfolderpath . $viewfileprefix . '.view.php';

        //check if file exists
        if(!file_exists($file)){
            throw new \Exception ("$file not found.");
        }
        //if it exists, require it
        require $file;
    }
}