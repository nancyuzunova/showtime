<?php


class User{

    public function get_data($id){
        $query = "select * from users where user_id = '$id' limit 1";
        $DB = new Connection();
        $result = $DB->read($query);

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }

    public function get_user($id){
        $query = "select * from users where user_id = '$id' limit 1";

        $DB = new Connection();
        $result = $DB->read($query);

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }

    public function get_friends($id){
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