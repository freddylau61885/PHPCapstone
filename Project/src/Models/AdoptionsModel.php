<?php

namespace App\Models;

use App\Lib\Model;

class AdoptionsModel extends Model
{
    /**
     * POST record
     *
     * @var array
     */
    private $post = [];

    /**
     * Search keyword
     *
     * @var string
     */
    private $search = '';
    

    /**
     * Adoption Model constructor
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
     * Set post data
     *
     * @param array $post
     * @return void
     */
    public function setPostData(array $post)
    {
        $this->post = $post;
    }

    /**
     * Insert adoption record
     *
     * @return integer
     */
    public function createTransaction():int
    {
        $dbh = self::$dbh;
        $query = "INSERT INTO $this->table
                  (
                    user_id,
                    ani_id                    
                  ) 
                  VALUES
                  (
                    :user_id,
                    :ani_id                    
                  )";                
        $statment = $dbh->prepare($query);
        $params = [
                ':user_id' => $this->post['user_id'], 
                ':ani_id' => $this->post['ani_id']
            ]; 
        $statment->execute($params);
        
        //return last insert id 
        return $dbh->lastInsertId();
    }

    /**
     * Check User already addop the animal
     *
     * @return integer
     */
    public function checkApplicationExist():int
    {
        $dbh = self::$dbh;
        $query = "SELECT count(*) amt                                 
                  FROM                   
                  $this->table
                  WHERE 
                  user_id = :user_id AND                  
                  ani_id = :ani_id";                
        $statment = $dbh->prepare($query);
        $params = [
            ':user_id' => $this->post['user_id'], 
            ':ani_id' => $this->post['ani_id']
        ]; 
        $statment->execute($params);
        $resp = $statment->fetch();              
        return $resp['amt'];
    }

    /**
     * Get all user adoption records
     *
     * @param integer $id
     * @return array
     */
    public function getUserAdoptionRecords(int $id):array
    {
        $dbh = self::$dbh;        
        $query = "SELECT            
         a.*,       
         ai.name       
         FROM $this->table a, animal_info ai
         WHERE 
         a.ani_id = ai.ani_id AND
         a.user_id = :id";

        $params = [
            ':id' => $id
        ];
        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $resp = $statment->fetchAll();
        return $resp;
    }

    /**
     * Get all adoptions in admin page
     *
     * @return array
     */
    public function getAllAdoptionsInAdmin():array
    {
        $dbh = self::$dbh;
        $params = [];
        $query = "SELECT
                  a.adoption_id,
                  ai.name,
                  u.login_id,
                  a.apprx_monthly_fee,                  
                  a.dewormed,
                  a.defleaed,
                  a.requirements,
                  a.status,
                  a.created_at,                  
                  a.updated_at                                    
                  FROM $this->table a, users u, animal_info ai WHERE
                  a.user_id = u.id AND a.ani_id = ai.ani_id"; 
       
        if($this->search){ 
            $query = "SELECT * FROM ($query) a WHERE";
            $bool = strtolower($this->search);
            if (floatval($this->search)){
                $query .= " 
                a.apprx_monthly_fee = :search OR
                a.adoption_id = :search";
                $params[":search"] = $this->search;
            }elseif ($bool == 'yes' || $bool == 'no'){
                $query .= " 
                a.dewormed = :search OR
                a.defleaed = :search
                ";
                $params[":search"] = $bool == 'yes' ? 1 : 0;
            }else{
                $query .= "                 
                a.name LIKE :search OR
                a.login_id LIKE :search OR                        
                a.requirements LIKE :search OR
                a.status LIKE :search";
                $params[":search"] = "%{$this->search}%";
            }           

        }        
                        
        $statment = $dbh->prepare($query);                
        $statment->execute($params);
        $resp = $statment->fetchAll();        
        return $resp;
    }

    /**
     * Get total adoptions
     *
     * @return array
     */
    public function getTotalAdoption():array
    {
        $dbh = self::$dbh;
        $query = " SELECT count(*) total 
                   from adoptions";

        $statment = $dbh->prepare($query);                
        $statment->execute();
        $resp = $statment->fetch();        
        return $resp ?? [];
    }

    /**
     * Get all adoption records total by status
     *
     * @return array
     */
    public function getAllQuantityByStatus():array
    {
        $dbh = self::$dbh;
        $query = " SELECT status, count(*) total 
                   from adoptions 
                   group by status";

        $statment = $dbh->prepare($query);                
        $statment->execute();
        $resp = $statment->fetchAll();        
        return $resp;
    } 
}
