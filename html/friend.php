<div id="friends">
    <?php
        $image = "../images/default-avatar.png";
        if(isset($userData) && isset($friend_row) && file_exists($friend_row['profile_image'])){
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