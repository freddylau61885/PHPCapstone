<?php

namespace App\Lib;

class Model
{
    /**
     * Database handler
     *
     * @var [type]
     */
    protected static $dbh;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = ''; 

    /**
     * Database handler setter
     *
     * @param \PDO $dbh
     * @return void
     */
    public static function initDB(\PDO $dbh)
    {
        self::$dbh = $dbh;
    }

    /**
     * Get All records reversely
     *
     * @return array
     */
    public function getAllRecordsReverse():array
    {
        $dbh = self::$dbh;
        $query = "SELECT * FROM $this->table ORDER BY id DESC";        

        $statment = $dbh->prepare($query);
        $statment->execute();
        $resp = $statment->fetchAll();        
        return $resp;
    }

    /**
     * Get All records reversely
     *
     * @return array
     */
    public function getAllRecords():array
    {
        $dbh = self::$dbh;
        $query = "SELECT * FROM $this->table";        

        $statment = $dbh->prepare($query);
        $statment->execute();
        $resp = $statment->fetchAll();        
        return $resp;
    }


    /**
     * Get one record by id
     *
     * @param int $id
     * @return array|boolean
     */
    public function getOneRecordByAniId(int $id):array|bool
    {
        $dbh = self::$dbh;
        $query = "SELECT * FROM $this->table WHERE 
                  ani_id = :id AND
                  is_active = 1";          

        $statment = $dbh->prepare($query);
        $param = [
            ':id' => $id
        ];
        $statment->execute($param);        
        $resp = $statment->fetch();                
        return $resp;
    }

    /**
     * Get field headers
     *
     * @return array
     */
    public function getfields():array
    {
        $dbh = self::$dbh;
        $query = "DESC $this->table";        

        $statment = $dbh->prepare($query);        
        $statment->execute();
        $resp = $statment->fetchAll();  
        $resp = array_map(function($row){return $row['Field'];}, $resp);      
        return $resp;
    }

    /**
     * Get all Records By Animal ID
     *
     * @param integer $id
     * @return array
     */
    public function getAllRecordsByAniID(int $id):array
    {
        $dbh = self::$dbh;        
        $query = "SELECT 
         *
         FROM $this->table WHERE 
         ani_id = :id";        
        
        $param = [
            ':id' => $id
        ];
       
        $statment = $dbh->prepare($query);
        $statment->execute($param);
        $user = $statment->fetchAll();
        return $user;
    }   
    
}