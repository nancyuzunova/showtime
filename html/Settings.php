<?php


class Settings{
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
        $oldPassword = addslashes($data['password']);
        $newPassword = addslashes($data['password2']);
        $confirmPassword = addslashes($data['password3']);
        $query = "SELECT password FROM users WHERE user_id = '$id' limit 1";
        $row = $DB->read($query);
        if ($row[0]){
            $password = $row[0]['password'];
            if ($password == hash("sha1", $oldPassword)){
                if ($newPassword == $confirmPassword && $newPassword != $oldPassword){
                    $hashed = hash("sha1", $newPassword);
                    $query = "UPDATE users SET password = '$hashed' WHERE user_id = '$id' limit 1";
                    $DB->write($query);
                }
            }
        }
    }
}