<?php
    session_start();
    include("Connection.php");
    include("Loging.php");
    include("User.php");
    include("Post.php");

    if(isset($_SESSION['showtime_userid']) && is_numeric($_SESSION['showtime_userid'])){
        $user_id = $_SESSION['showtime_userid'];
        $user = new User();
        $user_data = $user->get_data($user_id);
    }else{
        header("Location: login_page.php");
        die;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $post = new Post();
        $user_id = $_SESSION['showtime_userid'];
        $result = $post->create_post($user_id,$_POST);

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

    $post = new Post();
    $user_id = $_SESSION['showtime_userid'];

    $posts = $post->get_posts($user_id);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="../css/profile.css">
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    </head>

    <body>
        <!--Page top bar-->
        <div id="topBar">
            <div id="inTopBar">
                myBook &nbsp &nbsp &nbsp<input type="text" id="searchBox" placeholder="Други потребители">
                <a href="logout.php">
                <span style="font-size:11px; color: white; float: right; margin: 10px;">Изход</span>
                </a>
                <img src="../images/user.jpg" style="width: 50px; float: right; border-radius:50%;">
            </div>
        </div>

        <!--Cover area-->
        <div id="profileMainDiv">
            <div id="mainDivBackground">
                <img src="../images/sea.jpg" style="width:100%;">
                <img id="profilePic" src="../images/user.jpg">
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
                        <div id="friends">
                            <img id="friendsImg" src="../images/user1.jpg">
                            <br>
                            Мери Пери
                        </div>
                        <div id="friends">
                            <img id="friendsImg" src="../images/user1.jpg">
                            <br>
                            Мери Пери
                        </div>
                        <div id="friends">
                            <img id="friendsImg" src="../images/user1.jpg">
                            <br>
                            Мери Пери
                        </div>
                        <div id="friends">
                            <img id="friendsImg" src="../images/user1.jpg">
                            <br>
                            Мери Пери
                        </div>
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