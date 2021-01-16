<?php

class Settings{
    const PASSWORD_PATTERN = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/";


    public function getSettings($userId){
        $DB = new Connection();
        $query = "select * from users where user_id = '$userId' limit 1";
        $row = $DB->read($query);

        if(is_array($row)){
            return $row[0];
        }
    }

    public function saveSettings($data, $id){
        $DB = new Connection();

        unset($data['password2']);

        $query = "update users set ";
        foreach ($data as $key => $value){
            if($key == "firstName"){
                $query .= "first_name" . "='" . $value . "',";
            }elseif($key == "lastName"){
                $query .= "last_name" . "='" . $value . "',";
            }else{
                $query .= $key . "='" . $value . "',";
            }
        }

        $query = trim($query, ",");
        $query .= " where user_id = '$id' limit 1";
        $DB->write($query);
    }

    public function changePassword($data, $id){
        $DB = new Connection();
        $errorPassword = "";
        $oldPassword = addslashes($data['password']);
        $newPassword = addslashes($data['password1']);
        $confirmPassword = addslashes($data['password2']);
        $query = "SELECT password FROM users WHERE user_id = '$id' limit 1";
        $row = $DB->read($query);
        if ($row[0]){
            $hashedPassword = $row[0]['password'];
            if (password_verify($oldPassword, $hashedPassword)){
                if(strlen($newPassword) > 5 && preg_match(self::PASSWORD_PATTERN, $newPassword)) {
                    if ($newPassword == $confirmPassword && $newPassword != $oldPassword) {
                        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
                        if ($hashed) {
                            $query = "UPDATE users SET password = '$hashed' WHERE user_id = '$id' limit 1";
                            $DB->write($query);
                        }
                    } else {
                        $errorPassword = $errorPassword . "Error password confirm!";
                    }
                }else{
                    $errorPassword = $errorPassword . "Your password must contain at least 1 letter and 1 number!!";
                }
            }else{
                $errorPassword = $errorPassword . "Wrong password!";
            }
        }

        return $errorPassword;
    }
}