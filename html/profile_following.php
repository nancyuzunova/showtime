<div class="settingsDiv1">
    <div style="padding: 20px;">
        <?php
        $likes = new Post();
        $user = new User();
        if(isset($userData)) {
            $following = $user->getFollowing($userData['user_id'], "user");
        }

        if(is_array($following)){
            foreach ($following as $follower) {
                $friend_row = $user->getUser($follower['user_id']);
                include("friend.php");
            }
        }else{
            echo "This user isn't following anyone!";
        }
        ?>
    </div>
</div>
