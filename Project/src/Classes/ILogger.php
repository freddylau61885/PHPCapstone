<?php
namespace App\Classes;

interface ILogger
{
    /**
     * Undocumented function
     *
     * @param string $event
     * @return void
     */
    public function write(string $event);
}