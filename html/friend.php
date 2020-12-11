<div id="friends">
    <?php
        $image = "../images/male.jpg";
        if($friend_row['gender'] == "female"){
            $image = "../images/female.jpg";
        }
    ?>
    <img id="friendsImg" src="<?php echo $image ?>">
    <br>
    <?php echo $friend_row['first_name'] . " " . $friend_row['last_name']; ?>
</div>