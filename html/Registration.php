<?php

class Registration{

    const EMAIL_PATTERN = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

    private $error = "";

    public function evaluate($data){
        foreach($data as $key => $value){
            $value = trim($value);
            if(empty($value)){
                if($key == "firstName") {
                    $this->error = $this->error . "Моля въведете вашето име!<br>";
                }
                if($key == "lastName") {
                    $this->error = $this->error . "Моля въведете вашата фамилия!<br>";
                }
                if($key == "password") {
                    $this->error = $this->error . "Моля въведете парола!<br>";
                }
                if($key == "password1") {
                    $this->error = $this->error . "Моля повторете вашата парола!<br>";
                }
                if($key == "email") {
                    $this->error = $this->error . "Моля въведете вашеия имейл!<br>";
                }
            }
            if ($key == "email"){
                if (!preg_match(self::EMAIL_PATTERN, $value)){
                    $this->error = $this->error . "Невалиден имейл адрес!<br>";
                }
            }
            if ($key == "firstName"){
                if (is_numeric($value)){
                    $this->error = $this->error . "Вашето име не може да съдържа цифри!<br>";
                }
                if (strstr($value, " ")){
                    $this->error = $this->error . "Вашето име не може да съдържа празни пространства!<br>";
                }
            }
            if ($key == "lastName"){
                if (is_numeric($value)){
                    $this->error = $this->error . "Вашата фамилия не може да съдържа цифри!<br>";
                }
                if (strstr($value, " ")){
                    $this->error = $this->error . "Вашата фамилия не може да съдържа празни пространства!<br>";
                }
            }
        }

        if($this->error == ""){
            $this->create_user($data);
        }else{
            return $this->error;
        }
    }

    public function create_user($data){
        $userId = $this->create_userid();
        $firstName = ucfirst($data['firstName']);
        $lastName = ucfirst($data['lastName']);
        $email = $data['email'];
        $password = $this->hashText($data['password']);
        $gender = $data['gender'];
        $url = strtolower($firstName) .  "." . strtolower($lastName);
        
        $query = "insert into 
                    users (user_id, first_name, last_name, email, password, gender, url) 
                    values ('$userId', '$firstName' , '$lastName' , '$email' , '$password' , '$gender' , '$url')";
        
        $DB = new Connection();
        $result = $DB->write($query);
        if ($result){
            $_SESSION['showtime_userid'] = $userId;
        } else {
            $this->error = "Invalid input!";
        }
    }

    private function hashText($text){
        $text = hash("sha1", $text);
        return $text;
    }

    private function create_userid(){
        $length = rand(4, 11);
        $number = "";
        for($i=0; $i<$length; $i++){
            $new_rand = rand(0, 9);
            $number = $number . $new_rand;
        }

        return $number;
    }
}