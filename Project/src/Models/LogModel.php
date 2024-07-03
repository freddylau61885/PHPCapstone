<?php

namespace App\Models;

use App\Lib\Model;

class LogModel extends Model
{

    /**
     * Log model Constructor
     */
    public function __construct()
    {
        $this->table = 'log';
    }

    /**
     * Insert event to log table
     *
     * @param string $event
     * @return void
     */
    public function logDatabase(string $event):void
    {
        $dbh = self::$dbh;
        $query = "INSERT INTO log
        (
         event
        )
        VALUES
        (
         :event
        )";

        $params = [
            ':event' => $event
        ];

        $statment = $dbh->prepare($query);
        $statment->execute($params);
    }
    
}