<div id="friends">
    <?php
        $image = "../images/male.jpg";
        if (isset($friend_row['gender']) && $friend_row['gender'] == "female") {
            $image = "../images/female.jpg";
        }
        if (file_exists($friend_row['profile_image'])) {
            $editor = new ImageEditor();
            $image = $editor->getThumbProfile($friend_row['profile_image']);
        }
    ?>
    <a href="profile.php?id=<?php echo $friend_row['user_id']; ?>">
        <img id="friendsImg" style="width: 75px; border-radius: 50%;" src="<?php echo $image ?>">
        <br>
        <div style="text-decoration: none; color: #0392ce;">
            <?php echo $friend_row['first_name'] . " " . $friend_row['last_name']; ?>
        </div>
        <br>
    </a>
</div>