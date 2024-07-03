<?php
namespace App\Lib;

use App\Classes\{ILogger,DatabaseLogger,FileLogger};

class Utils
{

    /**
     * escape function for HTML output
     *
     * @param string $str
     * @return string
     */
    static public function esc(string $str): string
    {
        return htmlentities($str, ENT_QUOTES);
    }

    /**
     * return raw string output
     *
     * @param string $str
     * @return string
     */
    static public function raw(string $str): string
    {
        return $str;
    }

    /**
     * format string to first character uppercase
     *
     * @param string $str
     * @return string
     */
    static public function lowercaseAndUcwords(string $str): string
    {
        return ucwords(strtolower($str));
    }

    /**
     * login and redirect 
     *
     * @param integer $id
     * @param string $name
     * @param integer $is_admin
     * @param integer $register
     * @return void
     */
    static public function login(
        int $id, string $name, int $is_admin, int $register = 0
    ): void
    {
        session_regenerate_id();
        $_SESSION['user']['id'] = $id;
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['isadmin'] = $is_admin;
        $_SESSION['register'] = $register;

        if($is_admin){
            header("Location: /admin");
        }else{
            header("Location: /user_profile");
        }
        die;
    }

    /**
     * logout function
     *
     * @return void
     */
    static public function logout(): void
    {
        session_destroy();
        session_start();
        //reset the csrf
        if(empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32));
        }
        $_SESSION['success'] = 'logged out successfully!';
        header('Location: /login');
        die;
    }

    /**
     * create event string
     *
     * @param string $level
     * @param string $message
     * @return string
     */
    static public function createLogEvent(string $level, string $message):string 
    {
        $event = date('Y-m-d h:i:s') . ' | ' .
                 $level . ' | ' .
                 $_SERVER['REQUEST_METHOD'] . ' | ' .
                 $_SERVER['REQUEST_URI'] . ' | ' .
                 $_SERVER['REMOTE_ADDR'] . ' | ' .
                 http_response_code() . ' | ' .
                 $message; 
        
        return $event;
    }

    /**
     * log the event to database or file
     *
     * @param ILogger $logger
     * @param string $event
     * @return void
     */
    static public function logEvent(ILogger $logger, string $event):void
    {
        $logger->write($event);
    }

    /**
     * Check user logged in
     *
     * @param DatabaseLogger|FileLogger $logger
     * @return void
     */
    static public function checkUserLoggedin(
        DatabaseLogger|FileLogger $logger
    ):void
    {                         
        if (!isset($_SESSION['user'])) {
            $event = self::createLogEvent('INFO', "Unauthorized access");
            self::logEvent($logger, $event);

            $_SESSION['error'] = 'You are not logged in';
            header('Location: login');
            die;
        }
    }
    
    /**
     * Check user is admin
     *
     * @param DatabaseLogger|FileLogger $logger
     * @return void
     */
    static public function checkUserIsAdmin(
        DatabaseLogger|FileLogger $logger
    ):void
    {        
        if (!$_SESSION['user']['isadmin']) {
            $event = self::createLogEvent('INFO', "Unauthorized access");
            self::logEvent($logger, $event);

            $_SESSION['error'] = 'Only admin can view this page';
            header("Location: home");
            die();
        }
    }

    /**
     * Check admin logged in
     *
     * @param DatabaseLogger|FileLogger $logger
     * @return void
     */
    static public function checkAdminLoggedIn(
        DatabaseLogger|FileLogger $logger
    ):void
    {
        self::checkUserLoggedin($logger);
        self::checkUserIsAdmin($logger);
    }

    /**
     * Get current page
     *
     * @return string
     */
    static public function getCurrentPage():string
    {
        $page = explode('?',trim($_SERVER['REQUEST_URI'], '/'))[0] ?? '';
        $page = empty($page) ? 'admin' : $page;
        return $page;
    }

    /**
     * Check page using POST method
     *
     * @param DatabaseLogger|FileLogger $logger
     * @return void
     */
    static public function checkPageUsingPostMethod(
        DatabaseLogger|FileLogger $logger
        ):void
    {
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            $event = self::createLogEvent('ERROR', 
            "Unsupport request method: {$_SERVER['REQUEST_METHOD']}");    
            self::logEvent($logger, $event);
            die($event);
        }
    }

    /**
     * Check CSRF token
     *
     * @return void
     */
    static public function checkCSRFToken():void
    {
        if(empty($_POST['csrf']) || $_POST['csrf'] != $_SESSION['csrf']) {
            die('CSRF token mismatch');
        }
    }
}
