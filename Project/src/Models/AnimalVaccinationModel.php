<?php

namespace App\Models;

use App\Lib\Model;

class AnimalVaccinationModel extends Model
{
    /**
     * Search keyword
     *
     * @var string
     */
    private $search = '';

    /**
     * animal_img Model constructor
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
     * Get all animal Vaccines information
     *
     * @return array
     */
    public function getAllVaccines():array
    {
        $dbh = self::$dbh;
        $params = [];
        $query = "SELECT            
         vac_id,
         species,
         vac_name
         FROM $this->table";        
        
        if($this->search){ 
            $query = "SELECT * FROM ($query) a WHERE 
                a.vac_id LIKE :search OR
                a.species LIKE :search OR
                a.vac_name LIKE :search";                                            
                $params[":search"] = "%{$this->search}%";       
        } 

        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $user = $statment->fetchAll();
        return $user;
    }
}