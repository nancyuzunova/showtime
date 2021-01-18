<div id="post">
    <div>
        <?php
            $image = "../images/default-avatar.png";
            if (isset($row_user) && file_exists($row_user['profile_image'])) {
                $editor = new ImageEditor();
                $image = $editor->getThumbProfile($row_user['profile_image']);
            }
        ?>
        <a href="profile.php?id=<?php echo $row_user['user_id']; ?>"><img src="<?php echo $image ?>" class="commentUserPic"></a>
    </div>
    <div class="fullWidth">
        <div>
            <?php
                if(isset($row)) {
                    echo "<a class='userPostName' href='profile.php?id=$row[user_id]'>";
                    echo htmlspecialchars($row_user['first_name']) . " " . htmlspecialchars($row_user['last_name']);
                    echo "</a>";
                }
                if ($row['is_profile_image']) {
                    $pronoun = "his";
                    if ($row_user['gender'] == "female") {
                        $pronoun = "her";
                    }
                    echo "<span class='updatedText'> updated $pronoun profile image</span>";
                }
                if ($row['is_cover_image']) {
                    $pronoun = "his";
                    if ($row_user['gender'] == "female") {
                        $pronoun = "her";
                    }
                    echo "<span class='updatedText'> updated $pronoun cover image</span>";
                }
            ?>
            <span class="postRightText">
                <?php
                    $post = new Post();
                    if ($post->isMyPost($row['post_id'], $_SESSION['showtime_userid'])) {
                        echo "
                                <a class='userPostName' href='edit.php?id=$row[post_id]'>Edit</a> |
                                <a class='userPostName' href='delete.php?id=$row[post_id]'>Delete</a>";
                    }
                ?>
            </span>
        </div>
        <div class="postContent">
            <?php echo htmlspecialchars($row['post']); ?>
        </div>

        <?php
            if (file_exists($row['image'])) {
                $editor = new ImageEditor();
                $postImage = $editor->getThumbPost($row['image']);
                echo "<div class='postContent'>";
                echo "<img src='$postImage' style='width: 80%;'>";
                echo "</div>";
            }
        ?>
        <br><br>
        <?php
            $likesText = ($row['likes'] > 0) ? "(" . $row['likes'] . ")" : "";
            $iLiked = false;
            if(isset($_SESSION['showtime_userid'])){
                $userId = $_SESSION['showtime_userid'];
                $DB = new Connection();
                $query = "select likes from likes where type = 'post' && content_id = '$row[post_id]' limit 1";
                $result = $DB->read($query);
                if (is_array($result)){
                    $likes = json_decode($result[0]['likes'], true);
                    $userIds = array_column($likes, "user_id");
                    if (in_array($userId, $userIds)) {
                        $iLiked = true;
                    }
                }
            }
            $like = $iLiked ? "Dislike" : "Like"
        ?>
        <a class="likeComment" href="like.php?type=post&id=<?php echo $row['post_id'];?>"><?php echo $like . $likesText?></a> |
        <?php
            $comments = "";
            if($row['comments'] > 0){
                $comments = "(" . $row['comments'] . ")";
            }
        ?>
        <a class="likeComment" href="singlePost.php?id=<?php echo $row['post_id'] ?>">Comment<?php echo $comments ?></a>
        <span class="postRightText"><?php echo htmlspecialchars($row['date']); ?></span>
        <?php
            if($row['likes']>0){
                echo "<br>";
                echo "<a class='whoLiked' href='likes.php?type=post&id=$row[post_id]'>";
                if($row['likes'] == 1){
                    if($iLiked){
                        echo "<div class='left'> You liked this post </div>";
                    }else{
                        echo "<div class='left'> One person liked this post </div>";
                    }
                }else{
                    if($iLiked){
                        $text = "others";
                        if($row['likes']-1 == 1){
                            $text = "other";
                        }
                        echo "<div class='left'>You and " . ($row['likes'] - 1) . " " . $text ." liked this post </div>";
                    }else{
                        echo "<div class='left'>" . $row['likes'] . " other liked this post </div>";
                    }
                }

                echo "</a>";
            }
        ?>
    </div>
</div>