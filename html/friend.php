<div id="friends">
    <?php
        $image = "../images/male.jpg";
        if ($friend_row['gender'] == "female") {
            $image = "../images/female.jpg";
        }
        if (file_exists($friend_row['profile_image'])) {
            $image = $editor->getThumbProfile($friend_row['profile_image']);
        }
    ?>
    <a href="profile.php?id=<?php echo $friend_row['user_id']; ?>">
        <img id="friendsImg" src="<?php echo $image ?>">
        <br>
        <?php echo $friend_row['first_name'] . " " . $friend_row['last_name']; ?>
    </a>
</div>