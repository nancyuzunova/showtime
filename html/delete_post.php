<div id="post">
    <div>
        <?php
            $image = "../images/default-avatar.png";
            if(isset($row_user)) {
                if ($row_user['gender'] == "female") {
                    $image = "../images/female.jpg";
                }
                if (file_exists($row_user['profile_image'])) {
                    $editor = new ImageEditor();
                    $image = $editor->getThumbProfile($row_user['profile_image']);
                }
            }
        ?>
        <img src="<?php echo $image ?>" class="commentUserPic">
    </div>
    <div class="fullWidth">
        <div>
            <?php
                if(isset($row)) {
                    echo "<a class='userPostName' href='profile.php?id=$row[user_id]'>";
                    echo htmlspecialchars($row_user['first_name']) . " " . htmlspecialchars($row_user['last_name']);
                    echo "</a>";
                }
            ?>
        </div>
        <div style="margin: 5px 5px 7px 10px; font-size: 17px;">
            <?php echo htmlspecialchars($row['post']); ?>
        </div>

        <br><br>
        <?php
            if (file_exists($row['image'])) {
                $editor = new ImageEditor();
                $postImage = $editor->getThumbPost($row['image']);
                echo "<img src='$postImage' style='width: 80%;'>";
            }
        ?>
    </div>
</div>