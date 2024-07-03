<?php

namespace App\Models;

use App\Lib\Model;

class AnimalImgModel extends Model
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
     * Get all animal images
     *
     * @return array
     */
    public function getAllImages():array
    {
        $dbh = self::$dbh;
        $params = [];
        $query = "SELECT   
         aimg.img_id,
         ai.name,
         aimg.img_path
         FROM $this->table aimg, animal_info ai WHERE aimg.ani_id = ai.ani_id";        
        
        if($this->search){ 
            $query = "SELECT * FROM ($query) a WHERE 
                a.img_id LIKE :search OR
                a.name LIKE :search OR
                a.img_path LIKE :search";                              
                $params[":search"] = "%{$this->search}%";       
        } 

        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $user = $statment->fetchAll();
        return $user;
    }

    /**
     * Insert multiple images
     *
     * @param array $file_paths
     * @param integer $id
     * @return void
     */
    public function insertImages(array $file_paths, int $id)
    {
        $dbh = self::$dbh;
        $query = "INSERT INTO $this->table 
                  (ani_id, img_path) 
                  VALUES 
                  (:id, :file_path)";
        $stmt = $dbh->prepare($query);
        foreach($file_paths as $path){
            $params = [
                ':id' => $id,
                ':file_path' => $path
            ];
            $stmt->execute($params);
        }
    }

    /**
     * Remove image by img_id
     *
     * @param integer $id
     * @return integer
     */
    public function deleteImgByID(int $id):int
    {
        $dbh = self::$dbh;
        $query = "DELETE FROM $this->table WHERE 
         img_id = :id";                        

        $statment = $dbh->prepare($query);
        $statment->bindValue(':id', $id, \PDO::PARAM_INT);
        $statment->execute();
        return $statment->rowCount();
    }
}