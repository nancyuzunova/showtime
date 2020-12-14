<div id="post">
    <div>
        <?php
            $image = "../images/male.jpg";
            if ($row_user['gender'] == "female") {
                $image = "../images/female.jpg";
            }
            if (file_exists($row_user['profile_image'])) {
                $image = $editor->getThumbProfile($row_user['profile_image']);
            }
        ?>
        <img src="<?php echo $image ?>" style="width: 75px; margin-right: 10px; border-radius: 50%;">
    </div>
    <div style="width: 100%">
        <div style="font-weight: bold; color: #405b9d;">
            <?php
            echo htmlspecialchars($row_user['first_name']) . " " . htmlspecialchars($row_user['last_name']);
            if ($row['is_profile_image']) {
                $pronoun = "his";
                if ($row_user['gender'] == "female") {
                    $pronoun = "her";
                }
                echo "<span style='font-weight: normal; color: gray'> updated $pronoun profile image</span>";
            }
            if ($row['is_cover_image']) {
                $pronoun = "his";
                if ($row_user['gender'] == "female") {
                    $pronoun = "her";
                }
                echo "<span style='font-weight: normal; color: gray'> updated $pronoun cover image</span>";
            }
            ?>
        </div>
        <?php echo htmlspecialchars($row['post']); ?>
        <br><br>
        <?php
        if (file_exists($row['image'])) {
            $editor = new ImageEditor();
            $postImage = $editor->getThumbPost($row['image']);
            echo "<img src='$postImage' style='width: 80%;'>";
        }
        ?>
        <br><br>
        <?php
            $likes = ($row['likes'] > 0) ? "(" . $row['likes'] . ")" : "";

        ?>
        <a href="like.php?type=post&id=<?php echo $row['post_id'];?>">Like<?php echo $likes?></a> . <a href="">Comment</a> .
        <span style="color: #999;"><?php echo htmlspecialchars($row['date']); ?></span>
        <span style="color: #999; float: right">
            <?php
                $post = new Post();
                if ($post->isMyPost($row['post_id'], $_SESSION['showtime_userid'])) {
                    echo "
                        <a href='edit.php'>Edit</a> .
                        <a href='delete.php?id=$row[post_id]'>Delete</a>";
                }
            ?>
        </span>
    </div>
</div>