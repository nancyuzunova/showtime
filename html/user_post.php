<div id="post">
    <div>
        <?php
        $image = "../images/male.jpg";
        if ($row_user['gender'] == "female") {
            $image = "../images/female.jpg";
        }

        ?>
        <img src="<?php echo $image ?>" style="width: 75px; margin-right: 4px;">
    </div>
    <div>
        <div style="font-weight: bold; color: #405b9d;"><?php echo $row_user['first_name'] . " " . $row_user['last_name']; ?></div>
        <?php echo $row['post']; ?>
        <br><br>
        <?php
            if (file_exists($row['image'])){
                $editor = new ImageEditor();
                $postImage = $editor->getThumbPost($row['image']);
                echo "<img src='$postImage' style='width: 80%;'>";
            }
        ?>
        <br><br>
        <a href="">Like</a> . <a href="">Comment</a> .<span style="color: #999;"><?php echo $row['date']; ?></span>
    </div>
</div>