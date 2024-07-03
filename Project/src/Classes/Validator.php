<?php
namespace App\Classes;

use App\Models\UserModel;

class Validator
{
    private $data = [];
    private $errors = [];
    private $user = [];    


    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /************************* Getters ****************************/
    /**
     * Getter for errors
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /************************* Setters ****************************/
    /**
     * Set User
     *
     * @param array $user
     * @return void
     */
    public function setUser(array $user):void
    {
        $this->user = $user;
    }    

    /************** Validate and Other functions ******************/

    /**
     * Main validation function
     *
     * @param array $validate_map
     * @return void
     */
    public function validate(array $validate_map):void
    {
        //Make array keys into new array
        $key_array = array_map(null, array_keys($validate_map));
        //check all form fields are not empty
        $this->validateRequired($key_array);
        //Run all function provided in $validate_map
        foreach ($key_array as $key) {
            $this->data[$key] = trim($this->data[$key]);            
            foreach ($validate_map[$key] as $func) {                           
                call_user_func_array(array($this, $func), array($key));                    
            }
        }
    }

    /**
     * Validate all required field
     *
     * @param array $required
     * @return void
     */
    public function validateRequired(array $required): void
    {
        //loop each field name
        foreach ($required as $key) {
            $val = $this->data[$key];
            $this->data[$key] = trim($val);
            $label = $this->label($key);
            if (empty($this->data[$key])) {
                $this->errors[$key][] = "$label is a required field";
            }
        }
    }
    /*********** Start of register form validate function ***************/
    /**
     * Validate Name fields
     *
     * @param string $field
     * @param integer $min_len
     * @param integer $max_len
     * @return void
     */
    public function validateName(string $field, int $min_len = 2, 
    int $max_len = 255): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];

            //check the length first
            $length = strlen($str);
            if ($length < $min_len || $length > $max_len) {
                $this->errors[$field][] = 
                "The length must between $min_len to $max_len characters.";
            }

            //use negation found out all invalid characters
            preg_match_all('/[^a-z\-\'\.\s]/i', $str, $matches);

            if (count($matches[0])) {
                $this->errors[$field][] =  
                'Not allow the following character(s): ' . 
                implode(', ', $matches[0]);
            }
        }
    }

    /**
     * Validate Street field
     *
     * @param string $field
     * @return void
     */
    public function validateStreet(string $field): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];

            if (!preg_match('/^[\da-z\-\'\.\#\s]{2,100}$/i', $str)) {
                $this->errors[$field][] = 
                'Street must contain 2 to 100 characters and contain only 
                numbers, words, space, hyphen, single quote, period, and hash.';
            }
        }
    }

    /**
     * Validate City field
     *
     * @param string $field
     * @return void
     */
    public function validateCity(string $field): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];

            //not accept #
            if (!preg_match('/^[\da-z\-\'\.\s]{2,100}$/i', $str)) {
                $this->errors[$field][] = 
                'City must contain 2 to 100 characters and contain only 
                numbers, words, space, hyphen, single quote, and period.';
            }
        }
    }

    /**
     * Validate Province and Country fields
     *
     * @param string $field
     * @return void
     */
    public function validateProvinceAndCountry(string $field): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];

            $label = $this->label($field);
            if (!preg_match('/^[a-z\.\s]{2,100}$/i', $str)) {
                $this->errors[$field][] = 
                "$label must contain 2 to 100 characters and contain only words, 
                space, and period.";
            }
        }
    }



    /**
     * Validate the email field
     *
     * @param string $field
     * @param integer $min_len
     * @param integer $max_len
     * @return void
     */
    public function validateEmail(string $field, int $min_len = 6, 
    int $max_len = 255): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];
            $length = strlen($str);
            if ($length < $min_len || $length > $max_len) {
                $this->errors[$field][] = 
                "The length must between $min_len to $max_len characters.";
            }
            //used filter_var function to validate email
            if (!filter_var($str, FILTER_VALIDATE_EMAIL)) {
                $this->errors[$field][] = 'Please enter a valid email address';
            }
        }
    }

    /**
     * Validate Canada Postal Code
     *
     * @param string $field
     * @return void
     */
    public function validatePostalCode(string $field): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];

            //Canada postal code first letter not accept d, f, i, o, u, w, z
            preg_match_all('/\b[dfiouwz]/i', $str, $matches);

            if (count($matches[0])) {
                $this->errors[$field][] = 
                'First character not allow the following character(s): ' . 
                implode(', ', $matches[0]);
            }

            //check the formate
            if (!preg_match('/^([a-z]\d){3}$/i', $str)) {
                $this->errors[$field][] = 
                'Please enter proper Canada Postal Code';
            }
        }
    }

    /**
     * Validate Phone
     *
     * @param string $field
     * @return void
     */
    public function validatePhone(string $field): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];

            //accept the format like (204)-240-9473, 204 240 9473 etc...
            if (!preg_match('/^(\(\d{3}\)|\d{3})([\s\-]?\d{3}){2}\d$/', $str)) 
            {
                $this->errors[$field][] = 
                'Please enter a 10 digits phone number';
            }
        }
    }

    /**
     * Validate login username
     *
     * @param string $field
     * @return void
     */
    public function validateLoginId(string $field): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];

            //max length of login id limited to 20
            $length = strlen($str);
            if ($length < 2 || $length > 20) {
                $this->errors[$field][] = 
                "The length must between 2 to 20 characters.";
            }

            //use negation found out all invalid characters
            preg_match_all('/[^a-z\_\.]/i', $str, $matches);

            if (count($matches[0])) {
                $this->errors[$field][] = 
                'Not allow the following character(s): ' 
                . implode(', ', $matches[0]);
            }
        }
    }

    /**
     * Validate password has minimun 8 characters, must contain a special 
     * character, an uppercase letter and a number
     *
     * @param string $field
     * @param integer $max_len
     * @return void
     */
    public function validatePassword(string $field, int $max_len = 255): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];
            //check the password at least 1 uppercase letter, 1 lowercase 
            //letter, 1 number, 1 puncuation, and at least have 8 characters
            if (!preg_match(
                '/(?=.*[A-Z]+)(?=.*[a-z]+)(?=.*[0-9])(?=.*[[:punct:]]+).{8,}/'
                , $str)) 
            {
                $this->errors[$field][] =  
                'Minimun 8 characters, must contain a special character, 
                an uppercase letter and a number';
            }

            //max length of password limited to 255            
            if (strlen($str) > $max_len) {
                $this->errors[$field][] =  
                "The maximium length is $max_len characters.";
            }
        }
    }

    /**
     * check email already exist
     *
     * @param string $field
     * @return void
     */
    public function isEmailExist(string $field): void
    {        
        $email = $this->data[$field];        
        $um = new UserModel('users');
        $user = $um->getUserByEmail($email);
        if ($user) {
            $this->errors[$field][] =  "The email already exist.";
        }
    }

    /**
     * Check password and confirm_password are match
     *
     * @param string $field
     * @return void
     */
    public function isPasswordMatch(string $field): void
    {
        if (!empty($this->data[$field])) {
            $str = $this->data[$field];

            //check password and confirm password are match
            if ($this->data['password'] !== $str) {
                $this->errors[$field][] = 'Passwords do not match';
            }
        }
    }


    /********** End of register form validate function *************/

    /*********** Start of login form validate function *************/
    /**
     * Check email is registered
     *
     * @param string $field
     * @return void
     */
    public function checkEmailregistered(string $field): void
    {
        //$user is an array of user data
        if (!$this->user) {
            $this->errors[$field][] =  "Invalid user email";
        }
    }

    /**
     * compare user password for login
     *
     * @param string $field
     * @return void
     */
    public function comparePassword(string $field): void
    {
        $password = $this->user[$field] ?? '';
        if (!password_verify($this->data[$field], $password)) {
            $this->errors[$field][] =  "Invalid password";
        }
    }

    /**************** End of login form validate function ********************/

    /*********** start of add edit admin page validate function ************/
    /**
     * Check file is image
     *
     * @param string $tmp_name
     * @param string $field
     * @return void
     */
    public function checkUploadedfileisimage(string $tmp_name, 
    string $field):void
    {
        $is_image = getimagesize($tmp_name);
        if(!$is_image){
            $this->errors[$field][] =  "Only image can be uploaded";
        }
    }

    /**
     * Check Description Length
     *
     * @param string $field
     * @return void
     */
    public function checkDescriptionlength(string $field):void
    {
        $str = $this->data[$field];
        if (!empty($str)) {
            //check length of string
            if(strlen($str) > 16777215)
            {
                $this->errors[$field][] =  "Description too long";
            }
        }        
    }

    public function validateDateFormat(string $field):void
    {
        $str = $this->data[$field];
        if (!empty($str)) {
            //check formate is yyyy-mm-dd
            if (!preg_match('/\d{4}-[0-1]\d{1}-[0-3]\d{1}/', $str)) {
                $this->errors[$field][] = 
                'Please enter yyyy-mm-dd date format';
            }
        }   
    }


    public function validateWeightAndHeight(string $field):void
    {
        $str = $this->data[$field];
        if (!empty($str)) {
            if (!preg_match('/\d+(\.\d{1,3})?/', $str)) {
                $this->errors[$field][] = 
                $field . 'field can only enter numbers';
            }
        }
    }
    /************* End of add edit admin page validate function **************/

    /**
     * Formate string value to label
     *
     * @param string $str
     * @return string
     */
    private function label(string $str): string
    {
        return ucwords(str_replace('_', ' ', $str));
    }
}
