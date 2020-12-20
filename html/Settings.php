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
        $password = $data['password'];
        if(strlen($password)<30){
            if($data['password'] == $data['password2']) {
                $data['password'] = hash("sha1", $password);
            }else{
                unset($data['password']);
            }
        }

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
}