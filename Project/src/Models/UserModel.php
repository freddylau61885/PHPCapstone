<?php

namespace App\Models;

use App\Lib\{Utils, Model};

class UserModel extends Model
{
    /**
     * Search keyword
     *
     * @var string
     */
    private $search = '';

    /**
     * user model constructor
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
     * insert user
     *
     * @return integer
     */
    public function insertUserAndReturnLastID($post): int
    {
        $dbh = self::$dbh;
        $query = "INSERT INTO users
     (
         first_name,
         last_name,
         street,
         city,
         postal_code,
         province,
         country,
         phone,
         email,
         login_id,
         password,
         subscribe_to_newsletter
     )
     VALUES
     (
         :first_name,
         :last_name,
         :street,
         :city,
         :postal_code,
         :province,
         :country,
         :phone,
         :email,
         :login_id,
         :password,
         :subscribe_to_newsletter
     )";

        $params = [
            ':first_name' => Utils::lowercaseAndUcwords($post['first_name']),
            ':last_name' => Utils::lowercaseAndUcwords($post['last_name']),
            ':street' => Utils::lowercaseAndUcwords($post['street']),
            ':city' => Utils::lowercaseAndUcwords($post['city']),
            ':postal_code' => strtoupper($post['postal_code']),
            ':province' => Utils::lowercaseAndUcwords($post['province']),
            ':country' => Utils::lowercaseAndUcwords($post['country']),
            ':phone' => preg_replace('/[^\d]/', '', $post['phone']),
            ':email' => strtolower($post['email']),
            ':login_id' => $post['login_id'],
            ':password' => password_hash($post['password'], PASSWORD_DEFAULT),
            ':subscribe_to_newsletter' => 
                isset($post['subscribe_to_newsletter']) ? 1 : 0
        ];

        $statment = $dbh->prepare($query);
        $success = $statment->execute($params);
        //if insert fail return 0
        if (!$success) {
            return 0;
        }
        //return last insert id 
        return $dbh->lastInsertId();
    }

    /**
     * return user by id
     *
     * @param integer $id
     * @return array|boolean
     */
    public function getUser(int $id): array|bool
    {
        $dbh = self::$dbh;
        $query = 'SELECT 
         first_name,
         last_name,
         street,
         city,
         postal_code,
         province,
         country,
         phone,
         email,
         login_id,
         subscribe_to_newsletter,
         created_at 
         FROM users
         WHERE 
         id=:id';

        $params = [
            ':id' => $id
        ];
        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $user = $statment->fetch();
        return $user;
    }

    /**
     * return user by email
     *
     * @param string $email
     * @return array
     */
    public function getUserByEmail(string $email): array
    {
        $dbh = self::$dbh;
        $query = 'SELECT   
         id,       
         email,
         login_id,
         password,
         is_admin
         FROM users
         WHERE 
         email=:email';

        $params = [
            ':email' => $email
        ];
        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $user = $statment->fetchAll();
        return $user;
    }

    /**
     * return user by email where is active
     *
     * @param string $email
     * @return array
     */
    public function getIsActiveUserByEmail(string $email): array
    {
        $dbh = self::$dbh;
        $query = 'SELECT   
         id,       
         email,
         login_id,
         password,
         is_admin
         FROM users
         WHERE 
         email=:email AND
         is_active = 1';

        $params = [
            ':email' => $email
        ];
        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $user = $statment->fetchAll();
        return $user;
    }
    
    /**
     * Get all users without password
     *
     * @return array
     */
    public function getAllUsers():array
    {
        $dbh = self::$dbh;
        $params = [];
        $query = "SELECT   
         id,
         first_name,
         last_name,
         email,
         street,
         city,
         postal_code,
         province,
         country,
         phone,
         login_id,         
         subscribe_to_newsletter,
         is_admin,
         is_active,
         created_at,
         updated_at
         FROM $this->table WHERE is_active = 1";        
        
        if($this->search){ 
            $query = "SELECT * FROM ($query) a WHERE";
            $bool = strtolower($this->search);
            if ($bool == 'yes' || $bool == 'no'){
                $query .= " 
                a.subscribe_to_newsletter = :search OR
                a.is_admin = :search
                ";
                $params[":search"] = $bool == 'yes' ? 1 : 0;
            }else{
                $query .= "  
                a.id LIKE :search OR
                a.first_name LIKE :search OR
                a.last_name LIKE :search OR
                a.email LIKE :search OR
                a.street LIKE :search OR
                a.city LIKE :search OR
                a.postal_code LIKE :search OR
                a.province LIKE :search OR
                a.country LIKE :search OR
                a.phone LIKE :search OR
                a.login_id LIKE :search";                
                $params[":search"] = "%{$this->search}%";
            }           

        } 

        $statment = $dbh->prepare($query);
        $statment->execute($params);
        $user = $statment->fetchAll();
        return $user;
    }

    /**
     * Get total users
     *
     * @return array
     */
    public function getTotalUsers():array
    {
        $dbh = self::$dbh;
        $query = " SELECT count(*) total 
                   from users WHERE 
                   is_active = 1";

        $statment = $dbh->prepare($query);                
        $statment->execute();
        $resp = $statment->fetch();        
        return $resp ?? [];
    }

    /**
     * Get total users and subscribers
     *
     * @return array
     */
    public function getTotalSubscriber():array
    {
        $dbh = self::$dbh;
        $query = " SELECT 'normal users' users, count(*) total 
                   from users WHERE
                   subscribe_to_newsletter = 0 AND
                   is_active = 1
                   UNION
                   SELECT 'subscribers' users, count(*) total 
                   from users WHERE
                   subscribe_to_newsletter = 1 AND
                   is_active = 1";

        $statment = $dbh->prepare($query);                
        $statment->execute();
        $resp = $statment->fetchAll();        
        return $resp;
    }
}
