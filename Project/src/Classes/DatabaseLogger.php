<?php
namespace App\Classes;

use App\Models\LogModel;

class DatabaseLogger implements ILogger
{    

    /**
     * Undocumented variable
     *
     * @var LogModel
     */
    private $lm;

    /**
     * Database logger constructor
     */
    public function __construct()
    {
        $this->lm = new LogModel();        
    }

    /**
     * Write log to database
     *
     * @param string $event
     * @return void
     */
    public function write($event)
    {        
        $this->lm->logDatabase($event);
    }

    /**
     * Read logs from database
     *
     * @return array
     */
    public function read():array
    {
        return $this->lm->getAllRecordsReverse();
    }
}