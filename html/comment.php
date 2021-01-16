<div id="post">
    <div>
        <?php
            $image = "../images/default-avatar.png";
            if (isset($row_user) && file_exists($row_user['profile_image'])) {
                $editor = new ImageEditor();
                $image = $editor->getThumbProfile($row_user['profile_image']);
            }
            if(isset($comment)) {
                $commentOwner = new User();
                $commentOwner = $commentOwner->getUser($comment['user_id']);
            }
        ?>
        <img src="<?php echo $editor->getThumbProfile($commentOwner['profile_image']) ?>" class="commentUserPic">
    </div>
    <div class="fullWidth">
        <div>
            <?php
                echo "<a class='userPostName' href='profile.php?id=$comment[user_id]'>";
                echo htmlspecialchars($commentOwner['first_name']) . " " . htmlspecialchars($commentOwner['last_name']);
                echo "</a>";
            ?>
        </div>
        <span class="postRightText">
            <?php
                $post = new Post();
                if ($post->isMyPost($comment['post_id'], $_SESSION['showtime_userid'])) {
                    echo "
                            <a class='userPostName' href='edit.php?id=$comment[post_id]'>Edit</a> |
                            <a class='userPostName' href='delete.php?id=$comment[post_id]'>Delete</a>";
                }
            ?>
        </span>
        <div style="margin: 5px 5px 7px 10px; font-size: 15px;">
            <?php echo htmlspecialchars($comment['post']); ?>
        </div>

        <?php
            if (file_exists($comment['image'])) {
                $editor = new ImageEditor();
                $postImage = $editor->getThumbPost($comment['image']);
                echo "<img src='$postImage' style='width: 80%;'>";
            }
        ?>
        <br><br>
        <?php
            $likes = ($comment['likes'] > 0) ? "(" . $comment['likes'] . ")" : "";
        ?>
        <a class="likeComment" href="like.php?type=post&id=<?php echo $comment['post_id'];?>">Like<?php echo $likes?></a>

        <span class="postRightText"><?php echo htmlspecialchars($comment['date']); ?></span>
        <?php
            $iLiked = false;
            if(isset($_SESSION['showtime_userid'])){
                $userId = $_SESSION['showtime_userid'];
                $DB = new Connection();
                $query = "select likes from likes where type = 'post' && content_id = '$comment[post_id]' limit 1";
                $result = $DB->read($query);
                if (is_array($result)){
                    $likes = json_decode($result[0]['likes'], true);
                    $userIds = array_column($likes, "user_id");
                    if (in_array($userId, $userIds)) {
                        $iLiked = true;
                    }
                }
            }
            if($comment['likes']>0){
                echo "<br>";
                echo "<a class='whoLiked' href='likes.php?type=post&id=$comment[post_id]'>";
                if($comment['likes'] == 1){
                    if($iLiked){
                        echo "<div style='text-align: left;'> You liked this post </div>";
                    }else{
                        echo "<div style='text-align: left;'> One person liked this post </div>";
                    }
                }else{
                    if($iLiked){
                        $text = "others";
                        if($comment['likes']-1 == 1){
                            $text = "other";
                        }
                        echo "<div style='text-align: left;'>You and " . ($comment['likes'] - 1) . " " . $text ." liked this post </div>";
                    }else{
                        echo "<div style='text-align: left;'>" . $comment['likes'] . " other liked this post </div>";
                    }
                }

                echo "</a>";
            }
        ?>
    </div>
</div>