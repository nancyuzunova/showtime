<?php

class Signup{

    const EMAIL_PATTERN = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

    private $error = "";

    public function evaluate($data){
        foreach($data as $key => $value){
            if(empty($value)){
                $this->error = $this->error . $key . " is empty!<br>";
            }
            if ($key == "email"){
                if (!preg_match(self::EMAIL_PATTERN, $value)){
                    $this->error = $this->error . "Invalid email address!<br>";
                }
            }
            if ($key == "first_name"){
                if (is_numeric($value)){
                    $this->error = $this->error . "First name can't be a number!<br>";
                }
            }
            if ($key == "last_name"){
                if (is_numeric($value)){
                    $this->error = $this->error . "Last name can't be a number!<br>";
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
        $user_id = $this->create_userid();
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $password = $data['password'];
        $gender = $data['gender'];
        $url = strtolower($first_name) .  "." . strtolower($last_name);
        
        $query = "insert into 
                    users (user_id, first_name, last_name, email, password, gender, url) 
                    values ('$user_id', '$first_name' , '$last_name' , '$email' , '$password' , '$gender' , '$url')";
        
        $DB = new Connection();
        $DB->write($query);
    }

    private function create_userid(){
        $length = rand(4, 19);
        $number = "";
        for($i=0; $i<$length; $i++){
            $new_rand = rand(0, 9);
            $number = $number . $new_rand;
        }

        return $number;
    }
}