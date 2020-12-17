<div style="min-height: 400px; width: 100%; background-color: white; text-align: center;">
    <div style="padding: 20px;">
        <?php
            $likes = new Post();
            $user = new User();
            $followers = $likes->getLikes($userData['user_id'], "user");

            if(is_array($followers)){
                foreach ($followers as $follower) {
                    $friend_row = $user->getUser($follower['user_id']);
                    include("friend.php");

                }

            }else{
                echo "No followers were found!";
            }
        ?>
    </div>
</div>
