<?php

class User{

    public function getUser($id){
        $id = addslashes($id);
        $query = "select * from users where user_id = '$id' limit 1";
        $DB = new Connection();
        $result = $DB->read($query);

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }

    public function getFriends($id){
        $id = addslashes($id);
        $query = "select * from users where user_id != '$id' ";

        $DB = new Connection();
        $result = $DB->read($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }
}