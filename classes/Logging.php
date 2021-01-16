<?php

class Logging{

    private $error = "";

    public function login($data){
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

        if(empty($data['email'])){
            $this->error .= "Please enter your email!<br>";
        }
        if(empty($data['password'])){
            $this->error .= "Please enter your password!<br>";
        }

        $query = "select * from users where email = '$email' limit 1";
        $DB = new Connection();
        $result = $DB->read($query);

        if ($result){
            $user = $result[0];
            if (password_verify($password, $user['password'])){
                $_SESSION['showtime_userid'] = $user['user_id'];
            } else {
                $this->error .= "Wrong password!<br>";
            }
        } else {
            $this->error .= "Couldn't find your email!<br>";
        }

        return $this->error;
    }
}