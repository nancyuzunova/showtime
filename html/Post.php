<?php

class Post
{

    private $error = "";

    public function createPost($userId, $data, $files)
    {
        if (!empty($data['post']) || !empty($files['file']['name']) || isset($data['is_profile_image']) || isset($data['is_cover_image'])) {
            $image = "";
            $hasImage = 0;
            $isCoverImage = 0;
            $isProfileImage = 0;

            if (isset($data['is_profile_image']) || isset($data['is_cover_image'])){
                $image = $files;
                $hasImage = 1;
                if (isset($data['is_cover_image'])) {
                    $isCoverImage = 1;
                }
                if (isset($data['is_profile_image'])) {
                    $isProfileImage = 1;
                }
            } else {
                if (!empty($files['file']['name'])) {
                    $folder = "../uploads/" . $userId . "/";
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                        file_put_contents($folder . "index.php", "");
                    }

                    $editor = new ImageEditor();
                    $image = $folder . $_FILES['file']['name'] . date("Y-m-d H-i-s") . ".jpg";
                    move_uploaded_file($_FILES['file']['tmp_name'], $image);
                    $editor->resizeImage($image, $image, 1500, 1500);
                    $hasImage = 1;
                }
            }

            $post = "";
            if (isset($data['post'])){
                $post = addslashes($data['post']);
            }
            $post_id = $this->createPostId();

            $query = "insert into posts (user_id, post_id, post, image, has_image, is_profile_image, is_cover_image) values ('$userId', '$post_id', '$post', '$image', '$hasImage', '$isProfileImage', '$isCoverImage')";

            $DB = new Connection();
            $DB->write($query);

        } else {
            $this->error .= "Please type something first!<br>";
        }

        return $this->error;
    }

    public function editPost( $data, $files)
    {
        if (!empty($data['post']) || !empty($files['file']['name'])) {
            $image = "";
            $hasImage = 0;

            if(!empty($files['file']['name'])) {
                $folder = "../uploads/" . $userId . "/";
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                        file_put_contents($folder . "index.php", "");
                    }

                    $editor = new ImageEditor();
                    $image = $folder . $_FILES['file']['name'] . date("Y-m-d H-i-s") . ".jpg";
                    move_uploaded_file($_FILES['file']['tmp_name'], $image);
                    $editor->resizeImage($image, $image, 1500, 1500);
                    $hasImage = 1;
                }

            $post = "";
            if (isset($data['post'])){
                $post = addslashes($data['post']);
            }
            $postId = addslashes($data['postId']);

            if($hasImage){
                $query = "update posts set post = '$post', image = '$image' where post_id = '$postId' limit 1";
            }else{
                $query = "update posts set post = '$post' where post_id = '$postId' limit 1";
            }

            $DB = new Connection();
            $DB->write($query);

        } else {
            $this->error .= "Please type something first!<br>";
        }

        return $this->error;
    }

    public function getPosts($user_id)
    {
        $user_id = addslashes($user_id);
        $query = "select * from posts where user_id = '$user_id' order by id desc limit 10";

        $DB = new Connection();
        $result = $DB->read($query);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getPostById($postId)
    {
        $postId = addslashes($postId);
        $query = "select * from posts where post_id = '$postId' limit 1";

        $DB = new Connection();
        $result = $DB->read($query);

        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function deletePost($postId){
        if (!is_numeric($postId)){
            return false;
        }
        $postId = addslashes($postId);
        $query = "delete from posts where post_id = '$postId' limit 1";

        $DB = new Connection();
        $DB->write($query);
    }

    public function isMyPost($postId, $userId){
        if (!is_numeric($postId)){
            return false;
        }
        $postId = addslashes($postId);
        $query = "select * from posts where post_id = '$postId' limit 1";

        $DB = new Connection();
        $result = $DB->read($query);
        if (is_array($result)){
            if ($result[0]['user_id'] == $userId){
                return true;
            }
        }
        return false;
    }

    public function getLikes($postId, $type){
        $DB = new Connection();
        if ($type == "post") {
            //get like details
            $query = "select likes from likes where type = 'post' && content_id = '$postId' limit 1";
            $result = $DB->read($query);
            if (is_array($result)) {
                $likes = json_decode($result[0]['likes'], true);
                return $likes;
            }
        }

        return false;
    }

    public function likePost($postId, $type, $userId){
        $DB = new Connection();
        if ($type == "post"){

            //save likes details
            $query = "select likes from likes where type = 'post' && content_id = '$postId' limit 1";
            $result = $DB -> read($query);
            if (is_array($result)){
                $likes = json_decode($result[0]['likes'], true);
                $userIds = array_column($likes, "user_id");
                if (!in_array($userId, $userIds)){
                    $arr["user_id"] = $userId;
                    $arr["date"] = date("Y-m-d H:i:s");
                    $likes[] = $arr;
                    $likes = json_encode($likes);
                    $query = "update likes set likes = '$likes' where type = 'post' && content_id = '$postId' limit 1";
                    $DB -> write($query);
                    //increment the posts table
                    $query = "update posts set likes = likes + 1 where post_id = '$postId' limit 1";
                    $DB -> write($query);
                }else{
                    $key = array_search($userId, $userIds);
                    unset($likes[$key]);
                    $likes = json_encode($likes);
                    $query = "update likes set likes = '$likes' where type = 'post' && content_id = '$postId' limit 1";
                    $DB -> write($query);
                    //decrement the posts table
                    $query = "update posts set likes = likes - 1 where post_id = '$postId' limit 1";
                    $DB -> write($query);
                }
            } else {
                $arr["user_id"] = $userId;
                $arr["date"] = date("Y-m-d H:i:s");
                $arr2[] = $arr;
                $likes = json_encode($arr2);
                $query = "insert into likes (type, content_id, likes) values ('$type', '$postId', '$likes')";
                $DB -> write($query);
                //increment the posts table
                $query = "update posts set likes = likes + 1 where post_id = '$postId' limit 1";
                $DB -> write($query);
            }
        }
    }

    private function createPostId()
    {
        $length = rand(4, 11);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            $new_rand = rand(0, 9);
            $number = $number . $new_rand;
        }

        return $number;
    }
}