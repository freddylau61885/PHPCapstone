<?php

namespace App\Models;

use App\Lib\{Utils, Model};

class CommentsModel extends Model
{

    /**
     * post record
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
     * Constructor of comment model
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
     * Get user comments by user id
     *
     * @param integer $id
     * @return array
     */
    public function getUserComments(int $id):array
    {
        $dbh = self::$dbh;
        $query = "SELECT            
         comments,       
         created_at       
         FROM $this->table
         WHERE 
         user_id = :id";

        $params = [
            ':id' => $id
        ];
        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $resp = $statment->fetchAll();
        return $resp;
    }

    /**
     * Get animal comments by animal id
     *
     * @param integer $id
     * @return array
     */
    public function getAnimalComments(int $id):array
    {
        $dbh = self::$dbh;
        $query = "SELECT 
                  u.login_id,
                  uc.comments,
                  uc.created_at                  
                  FROM 
                  users u,
                  $this->table uc,
                  animal_info ai
                  WHERE 
                  u.id = uc.user_id AND
                  ai.ani_id = uc.ani_id AND
                  uc.ani_id = :id AND
                  uc.is_active = 1";                
        $statment = $dbh->prepare($query);
        $param = [':id' => $id]; 
        $statment->execute($param);
        $resp = $statment->fetchAll();              
        return $resp;
    }

    /**
     * Insert user comment
     *
     * @return integer
     */
    public function writeComment():int
    {        
        $dbh = self::$dbh;
        $query = "INSERT INTO user_comments
                  (
                    user_id,
                    ani_id,
                    comments
                  ) 
                  VALUES
                  (
                    :user_id,
                    :ani_id,
                    :comments
                  )";                
        $statment = $dbh->prepare($query);
        $params = [
                ':user_id' => $this->post['user_id'], 
                ':ani_id' => $this->post['ani_id'],
                ':comments' => $this->post['comment']
            ]; 
        $statment->execute($params);
        
        //return last insert id 
        return $dbh->lastInsertId();
    }

    /**
     * Get all animal images
     *
     * @return array
     */
    public function getAllComments():array
    {
        $dbh = self::$dbh;
        $params = [];
        $query = "SELECT   
         c.id,
         u.login_id,
         ai.name,
         c.comments,
         c.created_at,                  
         c.updated_at
         FROM $this->table c, animal_info ai, users u WHERE 
         c.ani_id = ai.ani_id AND
         c.user_id = u.id AND
         c.is_active = 1";        
        
        if($this->search){ 
            $query = "SELECT * FROM ($query) a WHERE 
                a.id LIKE :search OR
                a.login_id LIKE :search OR
                a.name LIKE :search OR
                a.comments LIKE :search";                              
                $params[":search"] = "%{$this->search}%";       
        } 

        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $user = $statment->fetchAll();
        return $user;
    }
}