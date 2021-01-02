<?php

class Logging
{
    private $error = "";

    public function login($data){
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

        if(empty($data['email'])){
            $this->error .= "Моля въведете вашия имейл!<br>";
        }
        if(empty($data['password'])){
            $this->error .= "Моля въведете вашата парола!<br>";
        }

        $query = "select * from users where email = '$email' limit 1";

        $DB = new Connection();
        $result = $DB->read($query);

        if ($result){
            $user = $result[0];
            if ($this->hashText($password) == $user['password']){
                //create a session data
                $_SESSION['showtime_userid'] = $user['user_id'];
            } else {
                $this->error .= "Въведената парола е грешна!<br>";
            }
        } else {
            $this->error .= "Не съществува потребител с такъв имейл!<br>";
        }
        return $this->error;
    }

    private function hashText($text){
        $text = hash("sha1", $text);
        return $text;
    }

    public function checkLogin($id){
        $query = "select user_id from users where user_id = '$id' limit 1";

        $DB = new Connection();
        $result = $DB->read($query);

        if($result){
            return true;
        }

        return false;
    }
}