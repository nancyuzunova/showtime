<?php

class Registration{

    const EMAIL_PATTERN = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    const PASSWORD_PATTERN = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/";

    private $error = "";
    private $pass = "";

    public function evaluate($data){
        foreach($data as $key => $value){
            $value = trim($value);
            if(empty($value)){
                if($key == "firstName") {
                    $this->error = $this->error . "Please enter your first name!<br>";
                }
                if($key == "lastName") {
                    $this->error = $this->error . "Please enter your last name!<br>";
                }
                if($key == "password") {
                    $this->error = $this->error . "Please enter your password!<br>";
                }
                if($key == "password1") {
                    $this->error = $this->error . "Please confirm password!<br>";
                }
                if($key == "email") {
                    $this->error = $this->error . "Please enter your email!<br>";
                }
            }
            if ($key == "email"){
                $query = "select email from users";
                $DB = new Connection();
                $result = $DB->read($query);

                foreach ($result as $emailKey){
                    if (!empty($value) && strpos($emailKey['email'], $value) !== false) {
                        $this->error = $this->error . "User with this email already exists!<br>";
                        break;
                    }
                }
                if (!preg_match(self::EMAIL_PATTERN, $value)){
                    $this->error = $this->error . "Invalid email!<br>";
                }
            }
            if($key == "password"){
                if(strlen($value) < 6){
                    $this->error = $this->error . "Your password must be at least 6 characters!<br>";
                }
                if (!preg_match(self::PASSWORD_PATTERN, $value)){
                    $this->error = $this->error . "Your password must contain at least 1 letter and 1 number!<br>";
                }
                $pass = $value;
            }
            if($key == "password1"){
                if($pass != $value){
                    $this->error = $this->error . "Password confirm failed!<br>";
                }
            }
            if ($key == "firstName"){
                if (preg_match('~[0-9]+~', $value)){
                    $this->error = $this->error . "First name can't contain numbers!<br>";
                }
            }
            if ($key == "lastName"){
                if (preg_match('~[0-9]+~', $value)){
                    $this->error = $this->error . "Last name can't contain numbers!<br>";
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