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

    public function getFollowing($id, $type){
        $DB = new Connection();
        $type = addslashes($type);
        if (is_numeric($id)){
            //get following
            $query = "select following from likes where type = '$type' && content_id = '$id' limit 1";
            $result = $DB->read($query);
            if (is_array($result)) {
                $following = json_decode($result[0]['following'], true);
                return $following;
            }
        }

        return false;
    }

    public function followUser($id, $type, $userId){
        $DB = new Connection();

        //follow user
        $query = "select following from likes where type = '$type' && content_id = '$userId' limit 1";
        $result = $DB -> read($query);
        if (is_array($result)){
            $likes = json_decode($result[0]['following'], true);
            $userIds = array_column($likes, "user_id");
            if (!in_array($id, $userIds)){
                $arr["user_id"] = $id;
                $arr["date"] = date("Y-m-d H:i:s");
                $likes[] = $arr;
                $likes = json_encode($likes);
                $query = "update likes set following = '$likes' where type = '$type' && content_id = '$userId' limit 1";
                $DB -> write($query);
            }else{
                $key = array_search($id, $userIds);
                unset($likes[$key]);
                $likes = json_encode($likes);
                $query = "update likes set following = '$likes' where type = '$type' && content_id = '$userId' limit 1";
                $DB -> write($query);
            }
        } else {
            $arr["user_id"] = $id;
            $arr["date"] = date("Y-m-d H:i:s");
            $arr2[] = $arr;
            $following = json_encode($arr2);
            $query = "insert into likes (type, content_id, following ) values ('$type', '$userId', '$following')";
            $DB -> write($query);
        }
    }
}