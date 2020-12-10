<?php


class User{

    public function get_data($id){
        $query = "select * from users where user_id = '$id' limit 1";
        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }
}