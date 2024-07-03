<?php
ob_start();
session_start();

include_once __DIR__ . '/../src/includes/config.php';
$dbh = require __DIR__ . '/../src/includes/db_connect.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Classes\{FileLogger, DatabaseLogger};
use App\Controllers\{PageController, FileNotFoundController, Admin\AdminController};
use App\Lib\{Utils, Model};

if(empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = base64_encode( openssl_random_pseudo_bytes(32) );
}

//Use Database or File Logger
$logger = LOG_DB ? new DatabaseLogger() : new FileLogger(LOG_FILE_PATH);

$routes = [
    'home' => function () {
        //display the home page
        $pc = new PageController();
        $pc->home();
    },
    'news' => function () {
        //display the home page
        $pc = new PageController();
        $pc->news();
    },
    'dogadop' => function ($b='',$a='',$g='',$s='') {
        //display the home page
        $pc = new PageController();
        $pc->dogadop($b,$a,$g,$s);
    },
    'dogdetails' => function ($id='') {
        //display the home page
        $pc = new PageController();
        $pc->dogdetail($id);
    },
    'dogtrain' => function () {
        //display the home page
        $pc = new PageController();
        $pc->dogtrain();
    },
    'adopanimal' => function () {
        //display the home page
        $pc = new PageController();
        $pc->adopanimal();
    },
    'contact' => function () {
        //display the home page
        $pc = new PageController();
        $pc->contact();
    },
    'register' => function () {
        //display the home page
        $pc = new PageController();
        $pc->register();
    },
    'user_profile' => function () {
        //display the home page
        $pc = new PageController();
        $pc->userprofile();
    },
    'login' => function () {
        //display the home page
        $pc = new PageController();
        $pc->login();
    },
    'logout' => function () {
        //display the home page
        $pc = new PageController();
        $pc->logout();
    },
    'admin' => function () {
        //display the home page
        $ac = new AdminController();
        $ac->index();
    },
    'aniinfo' => function ($s='') {
        //display the home page
        $ac = new AdminController();
        $ac->aniinfo($s);
    },
    'adopt' => function ($s='') {
        //display the home page
        $ac = new AdminController();
        $ac->adops($s);
    },
    'users' => function ($s='') {
        //display the home page
        $ac = new AdminController();
        $ac->users($s);
    },
    'anivac' => function ($s='') {
        //display the home page
        $ac = new AdminController();
        $ac->ani_vac($s);
    },
    'comments' => function ($s='') {
        //display the home page
        $ac = new AdminController();
        $ac->comments($s);
    },
    'add_edit' => function ($id='') {
        //display the home page
        $ac = new AdminController();
        $ac->add_edit($id);
    },
    'deleteimg' => function () {
        //display the home page
        $ac = new AdminController();
        $ac->deleteimg();
    },
    'delete_rec' => function () {
        //display the home page
        $ac = new AdminController();
        $ac->deleterec();
    },
    'char_data' => function () {
        //display the home page
        $ac = new AdminController();
        $ac->getChartData();
    }
];

$page = explode('?',trim($_SERVER['REQUEST_URI'], '/'))[0] ?? '';
$page = empty($page) ? 'home' : $page;

try{
    Model::initDB($dbh);
}catch(Exception $e){
    echo $e->getMessage();
}

try {
    //if the page exist as array key in routes array
    if (array_key_exists($page, $routes)) {                        
        $event = Utils::createLogEvent('INFO', $_SERVER['HTTP_USER_AGENT']);
        Utils::logEvent($logger, $event);

        call_user_func_array($routes[$page], $_GET);
    } else {       
        //set a 404 status code
        http_response_code(404);
        $event = Utils::createLogEvent('INFO', $_SERVER['HTTP_USER_AGENT']);
        Utils::logEvent($logger, $event);

        $ec = new FileNotFoundController();
        $ec->fileNotFound();
    }
} catch (Exception $e) {
    $errMsg = $e->getMessage();     

    $event = Utils::createLogEvent('ERROR', $errMsg);
    Utils::logEvent($logger, $event);

    echo "Some issue occurred: $errMsg";
    die;
}
