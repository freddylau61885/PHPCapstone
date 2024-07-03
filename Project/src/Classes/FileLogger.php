<?php
namespace App\Classes;

class FileLogger implements ILogger
{
    /**
     * File Path for the log file
     *
     * @var string
     */
    private $filepath = '';

    /**
     * FileLogger Constructor
     *
     * @param string $filepath
     */
    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * Write to log file
     *
     * @param string $event
     * @return void
     */
    public function write($event)
    {
        file_put_contents($this->filepath, $event . PHP_EOL, FILE_APPEND);
    }

    /**
     * Read log file
     *
     * @return array
     */
    public function read():array
    {
        $logs = file_get_contents($this->filepath);
        $logs = rtrim($logs, PHP_EOL);
        $logs_array = array_reverse(explode(PHP_EOL,$logs));
        return $logs_array;
    }
}