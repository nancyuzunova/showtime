<div style="min-height: 400px; width: 100%; background-color: white; text-align: center;">
    <div style="padding: 20px;">
        <?php
            $DB = new Connection();
            $query = "select image, post_id from posts where has_image = 1 && user_id = $userData[user_id] order by id desc limit 30";
            $images = $DB->read($query);

            if(is_array($images)){
                foreach ($images as $imageRow) {
                    echo "<a href='singlePost.php?id=$imageRow[post_id]'>";
                    echo"<img src='$imageRow[image]' style='width: 150px; margin: 10px;'>";
                    echo "</a>";
                }

            }else{
                echo "No images were found!";
            }
        ?>
    </div>
</div>
