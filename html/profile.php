<?php
    session_start();
    include("Connection.php");
    include("Logging.php");
    include("User.php");
    include("Post.php");

    if(isset($_SESSION['showtime_userid']) && is_numeric($_SESSION['showtime_userid'])){
        $user_id = $_SESSION['showtime_userid'];
        $user = new User();
        $user_data = $user->getUser($user_id);
    }else{
        header("Location: login_page.php");
        die;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $post = new Post();
        $user_id = $_SESSION['showtime_userid'];
        $result = $post->createPost($user_id,$_POST);

        if($result == ""){
            header("Location: profile.php");
            die;
        }else{
            echo "<div style='text-align:center; font-size: 12px; color: white; background-color: gray'>";
            echo "<br>The following errors occurred:<br><br>";
            echo $result;
            echo "</div>";
        }
    }
    //Collect posts
    $post = new Post();
    $user_id = $_SESSION['showtime_userid'];
    $posts = $post->getPosts($user_id);

    //Collect friends
    $user = new User();
    $user_id = $_SESSION['showtime_userid'];
    $friends = $user->getFriends($user_id);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="../css/profile.css">
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    </head>

    <body>
        <?php include("header.php") ?>
        <!--Cover area-->
        <div id="profileMainDiv">
            <div id="mainDivBackground">
                <img src="../images/sea.jpg" style="width:100%;">
                <span style="font-size: 11px;">
                    <img id="profilePic" src="../images/user.jpg">
                    <br>
                    <a style="text-decoration: none;" href="change_profile_picture.php">Change picture</a>
                </span>
                <br>
                <div id="personName"><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?></div>
                <br>
                <div class="menuButtons">Timeline</div> 
                <div class="menuButtons">About</div> 
                <div class="menuButtons">Friends</div>
                <div class="menuButtons">Photos</div>
                <div class="menuButtons">Settings</div>
            </div>

            <!-- below cover area-->
            <div id="mainContain">

                <!--friends area-->
                <div style="min-height: 400px; flex: 1;">
                    <div id="friendsBar">
                        Friends<br>
                        <?php
                        if($friends){
                            foreach ($friends as $friend_row){
                                include("friend.php");
                            }
                        }
                        ?>
                    </div>
                </div>

                <!--post area-->
                <div style="min-height: 400px; flex: 2.5; padding: 20px 0 20px 20px;">
                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                        <form method="post">
                            <textarea name="post" placeholder="whats on your mind?"></textarea>
                            <input id="postButton" type="submit" value="post">
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

        </div>

    </body>

</html>