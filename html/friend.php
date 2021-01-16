<div id="friends">
    <?php
        $image = "../images/default-avatar.png";
        if(isset($userData) && isset($friend_row) && file_exists($friend_row['profile_image'])){
            $editor = new ImageEditor();
            $image = $editor->getThumbProfile($friend_row['profile_image']);
        }
    ?>
    <a href="profile.php?id=<?php echo $friend_row['user_id']; ?>">
        <img class="commentUserPic" src="<?php echo $image ?>">
        <br>
        <div>
            <?php
                    echo "<a class='userPostName' href='profile.php?id=$friend_row[user_id]'>";
                    echo htmlspecialchars($friend_row['first_name']) . " " . htmlspecialchars($friend_row['last_name']);
                    echo "</a>";

            ?>
        </div>
        <br>
    </a>
</div>