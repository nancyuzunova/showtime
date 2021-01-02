<div id="mainContain">

    <!--friends area-->
    <div style="min-height: 400px; flex: 1;">
        <div id="friendsBar">
            Following<br>
            <?php
            if($friends){
                foreach ($friends as $friend){
                    $friend_row = $user->getUser($friend['user_id']);
                    include("friend.php");
                }
            }
            ?>
        </div>
    </div>

    <!--post area-->
    <div style="min-height: 400px; flex: 2.5; padding: 20px 0 20px 20px;">
        <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
            <form method="post" enctype="multipart/form-data">
                <textarea name="post" placeholder="What's on your mind?"></textarea>
                <input type="file" name="file" class="uploadBox">
                <input id="postButton" type="submit" value="Post">
                <br>
            </form>
        </div>

        <!--Posts-->
        <div id="postsBar">
            <?php
                if($posts){
                    foreach ($posts as $row){
                        $user = new User();
                        $row_user = $user->getUser($row['user_id']);
                        include("user_post.php");
                    }
                }
            ?>
        </div>
    </div>
</div>