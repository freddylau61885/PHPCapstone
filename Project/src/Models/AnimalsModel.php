<?php

namespace App\Models;

use App\Lib\Model;

class AnimalsModel extends Model
{
    /**
     * Dog breeds
     *
     * @var string
     */
    private $breed = '';

    /**
     * Dog age
     *
     * @var string
     */
    private $age = '';

    /**
     * Dog gender
     *
     * @var string
     */
    private $gender = '';
    
    /**
     * Search keyword
     *
     * @var string
     */
    private $search = '';

    /**
     * Animal Model constructor
     *
     * @param string $table
     */
    public function __construct(string $table)
    {        
        $this->table = $table;        
    }

    /**
     * Set search keys
     *
     * @param array $get
     * @return void
     */
    public function setSearchKeyWords(array $get)
    {
        $this->breed = $get['b'];
        $this->age = $get['a'];
        $this->gender = $get['g'];
        $this->search = $get['s'];
    }

    /**
     * Generate complex query string
     *
     * @return array
     */
    public function createQueryStringAndParams():array
    {
        $params = [];
        $query = "SELECT
                  ani_id,
                  thumbnail_path,
                  name,
                  gender,
                  dob,
                  breed,  
                  YEAR(CURRENT_TIMESTAMP) - YEAR(dob) as age
                  FROM $this->table WHERE is_active = 1";  
        
        //check if filter breed
        if($this->breed){            
            $query .= " AND breed = :breed";  
            $params[":breed"] = $this->breed;
        }
        
        //check if filter gender
        if($this->gender){            
            $query .= " And gender = :gender";
            $params[":gender"] = $this->gender;
        }
        
        //check if use search function
        if($this->search){            
            $query .= " AND name LIKE :search OR 
            breed LIKE :search OR
            gender LIKE :search OR
            dob LIKE :search";
            $params[":search"] = "%{$this->search}%";
        }        
             
        //check if filter age
        if($this->age != ''){            
            $query .= " HAVING age = :age";
            $params[":age"] = $this->age;
        }

        return ['query' => $query, 'params' => $params];
    }

    /**
     * Get Filtered or All animal records
     *
     * @return array
     */
    public function getListAnimalsRecords():array
    {        
        $dbh = self::$dbh;
        $qap = $this->createQueryStringAndParams();
        $query = $qap['query'];             
        $params = $qap['params'];
        $statment = $dbh->prepare($query);                
        $statment->execute($params);
        $resp = $statment->fetchAll();        
        return $resp;
    }

    /**
     * Get all breed existed in table 
     *
     * @return array
     */
    public function getBreeds():array
    {
        $dbh = self::$dbh;
        $query = "SELECT
                  DISTINCT breed 
                  FROM $this->table WHERE
                  is_active = 1
                  order by breed";        

        $statment = $dbh->prepare($query);
        $statment->execute();
        $resp = $statment->fetchAll();        
        return $resp;
    }

    /**
     * Get all age existed in table 
     *
     * @return array
     */
    public function getAges():array
    {
        $dbh = self::$dbh;
        $query = "SELECT
                  DISTINCT YEAR(CURRENT_TIMESTAMP) - YEAR(dob) as age 
                  FROM $this->table WHERE
                  is_active = 1
                  order by age";        

        $statment = $dbh->prepare($query);
        $statment->execute();
        $resp = $statment->fetchAll();        
        return $resp;
    }

    /**
     * Get all images of an animal by id
     *
     * @param integer $id
     * @return array
     */
    public function getAnimalImages(int $id):array
    {
        $dbh = self::$dbh;
        $query = "SELECT *
                  FROM animal_img 
                  WHERE ani_id = :id";        

        $statment = $dbh->prepare($query);
        $param = [':id' => $id]; 
        $statment->execute($param);
        $resp = $statment->fetchAll();        
        return $resp;
    }

    /**
     * Get one animal record
     *
     * @param integer $id
     * @return array
     */
    public function getOneRecord(int $id):array
    {
        $dbh = self::$dbh;
        $query = "SELECT 
                  ai.*,
                  GROUP_CONCAT(av.vac_name SEPARATOR ', ') as Vaccinated
                  FROM 
                  $this->table ai
                  LEFT JOIN animal_info_vaccination aiv 
                  ON ai.ani_id = aiv.ani_id
                  LEFT JOIN animal_vaccination av 
                  ON av.vac_id = aiv.vac_id
                  WHERE 
                  ai.is_active = 1 AND
                  ai.ani_id = :id";                
        $statment = $dbh->prepare($query);
        $param = [':id' => $id]; 
        $statment->execute($param);
        $resp = $statment->fetch();        
        return $resp ?? [];
    }    

    /**
     * Get all animals in admin page
     *
     * @return array
     */
    public function getAllAnimalsInAdmin():array
    {
        $dbh = self::$dbh;
        $params = [];
        $query = "SELECT
                  ani_id,
                  name,
                  gender,                  
                  dob,
                  weight,
                  height,
                  breed,  
                  has_chip,  
                  neutered,  
                  behaviors,  
                  health,  
                  thumbnail_path,
                  created_at,                  
                  updated_at                  
                  FROM $this->table WHERE"; 
       
       //search records
        if($this->search){            
            $query .= " 
            ani_id LIKE :search OR
            name LIKE :search OR
            gender LIKE :search OR              
            dob LIKE :search OR
            weight LIKE :search OR
            height LIKE :search OR
            breed LIKE :search OR 
            has_chip LIKE :search OR 
            neutered LIKE :search OR
            behaviors LIKE :search OR  
            health LIKE :search OR  
            thumbnail_path LIKE :search
            AND";
            
            $params[":search"] = "%{$this->search}%";
        }        

        $query .= ' is_active = 1';
        $statment = $dbh->prepare($query);                
        $statment->execute($params);
        $resp = $statment->fetchAll();        
        return $resp;
    }

    /**
     * Update animal_info and related secondary tables
     *
     * @param integer $id
     * @param array $post
     * @param array $files
     * @return boolean
     */
    public function updateRecordByAniID(int $id, array $post, array $files):bool
    {
        try {
            $dbh = self::$dbh;
            $dbh->beginTransaction();
            $vacs = [];
            $params = [];
            $fields = '';
            //change has_chip and neutered to tinyint
            $post['has_chip'] = !isset($post['has_chip']) ? 0 : 1;
            $post['neutered'] = !isset($post['neutered']) ? 0 : 1; 

            //Move all vac_ prefix fields from $post to $vac, 
            //then generate key = value pair for query
            foreach ($post as $key => $value){
                if(strpos($key, 'vac_') === 0){
                    $vacs[$key] = $value;
                    unset($post[$key]);
                }else{
                    $fields .= " $key = :$key,";                                           
                    $params[":$key"] = $value;
                }
            }            
            
            $query = "UPDATE $this->table SET " 
            .rtrim($fields, ',') . 
            " WHERE ani_id = :id";
            
            $stmt = $dbh->prepare($query);
            $params[':id'] = $id;

            $stmt->execute($params);

            //check thumbnail uploaded
            $file_path = $files['thumbnail_path']['name'];
            if ($file_path){
                $this->updateThumbnail($file_path, $id);
            }
            
            //check other images uploaded
            $imgs_exist = $files['images']['name'][0];
            if($imgs_exist){
                $aim = new AnimalImgModel('animal_img');
                $aim->insertImages($files['images']['name'], $id);
            }

            //insert vac record
            if($vacs){
                $aivm = new AnimalInfoVaccinationModel(
                    'animal_info_vaccination'
                );
                $aivm->deleteByAniID($id);
                $aivm->insertVacInfo($vacs, $id);
            }

            // commit the transaction
	        $dbh->commit();
            return true;
        }catch (\PDOException $e) {
            // rollback the transaction
            $dbh->rollBack();
            die($e->getMessage());
            return false;
        }
    }

    /**
     * Update Thumbnail path
     *
     * @param string $file_path
     * @param integer $id
     * @return integer
     */
    public function updateThumbnail(string $file_path, int $id):int
    {
        $dbh = self::$dbh;
        $query = "UPDATE $this->table 
                  SET thumbnail_path = :thumbnail_path WHERE
                  ani_id = :id";

        $stmt = $dbh->prepare($query);
        $params = [
            ':thumbnail_path' => $file_path,
            ':id' => $id
        ];
        $stmt->execute($params);
        return $stmt->rowCount();
    }    

    /**
     * Insert animal_info and related secondary tables 
     *
     * @param integer $id
     * @param array $post
     * @param array $files
     * @return integer
     */
    public function insertRecordByAniID(array $post, array $files):int
    {
        try {
            $dbh = self::$dbh;
            $dbh->beginTransaction();
            $vacs = [];
            $params = [];
            $fields = '';
            $values = '';
            //change has_chip and neutered to tinyint
            $post['has_chip'] = !isset($post['has_chip']) ? 0 : 1;
            $post['neutered'] = !isset($post['neutered']) ? 0 : 1; 
            //Move all vac_ prefix fields from $post to $vac, 
            //then generate key and value string for query
            foreach ($post as $key => $value){
                if(strpos($key, 'vac_') === 0){
                    $vacs[$key] = $value;
                    unset($post[$key]);
                }else{
                    $fields .= " $key,";
                    $values .= " :$key,";                                           
                    $params[":$key"] = $value;
                }
            }
            
            //check thumbnail uploaded
            $file_path = $files['thumbnail_path']['name'];
            if ($file_path){  
                $fields .= " thumbnail_path,";
                $values .= " :thumbnail_path,";
                $params[':thumbnail_path'] = $file_path;              
            }
            
            $query = "INSERT INTO $this->table (" 
            .rtrim($fields, ',') 
            . " ) VALUES (" 
            .rtrim($values, ',') 
            . ")";
            
            $stmt = $dbh->prepare($query);            

            $stmt->execute($params);
            
            $id = $dbh->lastInsertId();
            
            //check other images uploaded
            $imgs_exist = $files['images']['name'][0];
            if($imgs_exist){
                $aim = new AnimalImgModel('animal_img');
                $aim->insertImages($files['images']['name'], $id);
            }

            //insert vac record
            if($vacs){
                $aivm = new AnimalInfoVaccinationModel(
                    'animal_info_vaccination'
                );                
                $aivm->insertVacInfo($vacs, $id);
            }

            // commit the transaction
	        $dbh->commit();
            return true;
        }catch (\PDOException $e) {
            // rollback the transaction
            $dbh->rollBack();
            die($e->getMessage());
            return false;
        }
    }

     /**
     * Remove animal by img_id
     *
     * @param integer $id
     * @return integer
     */
    public function deleteRecordByAniID(int $id)
    {    
        $dbh = self::$dbh;
        $query = "UPDATE $this->table 
         SET is_active = 0 WHERE 
         ani_id = :id";                        

        $statment = $dbh->prepare($query);
        $statment->bindValue(':id', $id, \PDO::PARAM_INT);
        $statment->execute();
        return $statment->rowCount();    
    }

    /**
     * Get all breed total in table
     *
     * @return array
     */
    public function getAllQuantityByBreed():array
    {
        $dbh = self::$dbh;
        $query = " SELECT breed, count(*) total 
                   from animal_info where 
                   is_active = 1 
                   group by breed
        ";

        $statment = $dbh->prepare($query);                
        $statment->execute();
        $resp = $statment->fetchAll();        
        return $resp;
    }

    /**
     * Get all age total in table
     *
     * @return array
     */
    public function getAllQuantityByAge():array
    {
        $dbh = self::$dbh;
        $query = " SELECT 
                   YEAR(CURRENT_TIMESTAMP) - YEAR(dob) as age, count(*) total 
                   from animal_info where 
                   is_active = 1 
                   group by age
        ";

        $statment = $dbh->prepare($query);                
        $statment->execute();
        $resp = $statment->fetchAll();        
        return $resp;
    }

    /**
     * get Max, Min, and Average age of animals
     *
     * @return array
     */
    public function getMaxMinAndAvgAge():array
    {
        $dbh = self::$dbh;
        $query = " SELECT 
                   MAX(YEAR(CURRENT_TIMESTAMP) - YEAR(dob)) max_age, 
                   MIN(YEAR(CURRENT_TIMESTAMP) - YEAR(dob)) min_age, 
                   ROUND(AVG(YEAR(CURRENT_TIMESTAMP) - YEAR(dob)),2) avg_age 
                   from animal_info where 
                   is_active = 1";

        $statment = $dbh->prepare($query);                
        $statment->execute();
        $resp = $statment->fetch();        
        return $resp ?? [];
    }

    /**
     * Get total animals
     *
     * @return array
     */
    public function getTotalAnimal():array
    {
        $dbh = self::$dbh;
        $query = " SELECT count(*) total 
                   from animal_info where 
                   is_active = 1";

        $statment = $dbh->prepare($query);                
        $statment->execute();
        $resp = $statment->fetch();        
        return $resp ?? [];
    }
}