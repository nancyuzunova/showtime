<?php


class Post{
    private $error = "";

    public function create_post($user_id, $data){
        if(!empty($data['post'])){
            $post = addslashes($data['post']);
            $post_id =$this->create_postid();

            $query = "insert into posts (user_id, post_id, post) values ('$user_id', '$post_id', '$post')";

            $DB = new Connection();
            $DB->write($query);

        }else{
            $this->error .= "Please type something first!<br>";
        }

        return $this->error;
    }

    private function create_postid(){
        $length = rand(4, 11);
        $number = "";
        for($i=0; $i<$length; $i++){
            $new_rand = rand(0, 9);
            $number = $number . $new_rand;
        }

        return $number;
    }
}