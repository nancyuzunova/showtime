<?php

class Loging
{
    private $error = "";

    public function login($data){
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

        $query = "select * from users where email = '$email' limit 1";

        $DB = new Connection();
        $result = $DB->read($query);

        if ($result){
            $user = $result[0];
            if ($password == $user['password']){
                //create a session data
                $_SESSION['showtime_userid'] = $user['user_id'];
            } else {
                $this->error .= "Wrong password!<br>";
            }
        } else {
            $this->error .= "No such email was found!<br>";
        }
        return $this->error;
    }

    public function check_login($id){
        $query = "select user_id from users where user_id = '$id' limit 1";

        $DB = new Connection();
        $result = $DB->read($query);

        if($result){
            return true;
        }

        return false;
    }
}