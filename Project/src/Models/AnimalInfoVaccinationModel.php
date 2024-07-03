<?php

namespace App\Models;

use App\Lib\Model;

class AnimalInfoVaccinationModel extends Model
{
    /**
     * Search keyword
     *
     * @var string
     */
    private $search = '';

    /**
     * animal_info_vaccination constructor
     *
     * @param string $table
     */
    public function __construct(string $table)
    {        
        $this->table = $table;        
    }

    /**
     * Set search keyword
     *
     * @param array $get
     * @return void
     */
    public function setSearchKeyWords(array $get)
    {        
        $this->search = $get['s'];
    }

    /**
     * Get all animal Vaccination Information
     *
     * @return array
     */
    public function getAllAniVacInfo():array
    {
        $dbh = self::$dbh;
        $params = [];
        $query = "SELECT 
         aiv.ani_id,           
         ai.name,
         aiv.vac_id,
         av.vac_name
         FROM $this->table aiv, animal_info ai, animal_vaccination av WHERE 
         aiv.ani_id = ai.ani_id AND
         aiv.vac_id = av.vac_id";        
        
        if($this->search){ 
            $query = "SELECT * FROM ($query) a WHERE 
                a.name LIKE :search OR
                a.vac_name LIKE :search";                                            
                $params[":search"] = "%{$this->search}%";       
        } 

        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $user = $statment->fetchAll();
        return $user;
    }    
     
    /**
     * Delete Vaccination records by ani_id
     *
     * @param integer $id
     * @return integer
     */
    public function deleteByAniID(int $id):int
    {
        $dbh = self::$dbh;
        $query = "DELETE FROM $this->table WHERE 
         ani_id = :id";                        

        $statment = $dbh->prepare($query);
        $statment->bindValue(':id', $id, \PDO::PARAM_INT);
        $statment->execute();
        return $statment->rowCount();
    }   

    /**
     * Insert new animal vaccination record
     *
     * @param array $vacs
     * @param integer $id
     * @return void
     */
    public function insertVacInfo(array $vacs, int $id)
    {
        $dbh = self::$dbh;
        $query = "INSERT INTO $this->table 
                  (ani_id, vac_id) 
                  VALUES 
                  (:id, :vac_id)";
        $stmt = $dbh->prepare($query);
        foreach($vacs as $vac_id){
            $params = [
                ':id' => $id,
                ':vac_id' => $vac_id
            ];            
            $stmt->execute($params);
        }
    }
}