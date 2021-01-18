<div id="mainContain">

    <!--friends area-->
    <div style="min-height: 400px; flex: 1;">
        <div id="friendsBar">
            Following<br>
            <?php
                if(isset($friends)) {
                    if ($friends) {
                        foreach ($friends as $friend) {
                            $user = new User();
                            $friend_row = $user->getUser($friend['user_id']);
                            include("friend.php");
                        }
                    }
                }
            ?>
        </div>
    </div>

    <!--post area-->
    <div class="editDelDiv1" style="padding-top: 0">
        <?php
            if (isset($userData) && $_SESSION['showtime_userid'] == $userData['user_id']){
                echo "<div class='postsBox'>
                    <form method='post' enctype='multipart/form-data'>
                        <textarea name='post' placeholder='What&apos;s on your mind?'></textarea>
                        <input type='file' name='file' class='uploadBox'>
                        <input id='postButton' type='submit' value='Post'>
                        <br>
                    </form>
                </div>";
            }
        ?>

        <!--Posts-->
        <div id="postsBar" style="background-color: #d0d8e4;">
            <?php
                if(isset($posts)) {
                    if ($posts) {
                        foreach ($posts as $row) {
                            $user = new User();
                            $row_user = $user->getUser($row['user_id']);
                            include("user_post.php");
                        }
                    }
                }
            ?>
        </div>
    </div>
</div>