<?php

class Post
{

    private $error = "";

    public function createPost($userId, $data, $files)
    {
        if (!empty($data['post']) || !empty($files['file']['name'])) {
            $image = "";
            $hasImage = 0;

            if (!empty($files['file']['name'])) {
                $folder = "../uploads/" . $userId . "/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $editor = new ImageEditor();
                $image = $folder . $_FILES['file']['name'] . date("Y-m-d H-i-s") . ".jpg";
                move_uploaded_file($_FILES['file']['tmp_name'], $image);
                $editor->resizeImage($image, $image, 1500, 1500);
                $hasImage = 1;
            }

            $post = addslashes($data['post']);
            $post_id = $this->createPostId();

            $query = "insert into posts (user_id, post_id, post, image, has_image) values ('$userId', '$post_id', '$post', '$image', '$hasImage')";

            $DB = new Connection();
            $DB->write($query);

        } else {
            $this->error .= "Please type something first!<br>";
        }

        return $this->error;
    }

    public function getPosts($user_id)
    {
        $query = "select * from posts where user_id = '$user_id' order by id desc limit 10";

        $DB = new Connection();
        $result = $DB->read($query);

        if ($result) {
            return $result;
        } else {
            return false;
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