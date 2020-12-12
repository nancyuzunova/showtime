<?php
    session_start();
    include("Connection.php");
    include("Logging.php");
    include("User.php");
    include("Post.php");
    include("ImageEditor.php");

    if(isset($_SESSION['showtime_userid']) && is_numeric($_SESSION['showtime_userid'])){
        $userId = $_SESSION['showtime_userid'];
        $user = new User();
        $userData = $user->getUser($userId);
    }else{
        header("Location: login_page.php");
        die;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $post = new Post();
        $userId = $_SESSION['showtime_userid'];
        $result = $post->createPost($userId,$_POST);

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
    $userId = $_SESSION['showtime_userid'];
    $posts = $post->getPosts($userId);

    //Collect friends
    $user = new User();
    $userId = $_SESSION['showtime_userid'];
    $friends = $user->getFriends($userId);

    $editor = new ImageEditor();
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
                <?php
                $cover = "../images/sea.jpg";
                if (file_exists($userData['cover_image'])){
                    $cover = $editor->getThumbCover($userData['cover_image']);
                }
                ?>
                <img src="<?php echo $cover?>" style="width:100%;">
                <span style="font-size: 11px;">
                     <?php
                     $image = "../images/default-avatar.png";
                     if (file_exists($userData['profile_image'])){
                         $image = $editor->getThumbProfile($userData['profile_image']);
                     }
                     ?>
                    <img id="profilePic" src="<?php echo $image?>">
                    <br>
                    <a style="text-decoration: none;" href="change_profile_picture.php?change=profile">Change profile picture</a> |
                    <a style="text-decoration: none;" href="change_profile_picture.php?change=cover">Change cover</a>
                </span>
                <br>
                <div id="personName"><?php echo $userData['first_name'] . " " . $userData['last_name'] ?></div>
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