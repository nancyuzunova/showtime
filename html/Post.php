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