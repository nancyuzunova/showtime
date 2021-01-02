<?php
    include("loader.php");

    if(isset($_SESSION['showtime_userid']) && is_numeric($_SESSION['showtime_userid'])){
        $userId = $_SESSION['showtime_userid'];
        $user = new User();
        $userData = $user->getUser($userId);
        $USER = $userData;
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $userData = $user->getUser($_GET['id']);
        }
    }else{
        header("Location: login_page.php");
        die;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $post = new Post();
        $user_id = $_SESSION['showtime_userid'];
        $result = $post->createPost($user_id,$_POST, $_FILES);

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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Timeline</title>
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/profile.css">
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    </head>

    <body>
        <?php include("header.php") ?>
        <!--Cover area-->
        <div id="profileMainDiv">
           

            <!-- below cover area-->
            <div id="mainContain">

                <!--friends area-->
                <div style="min-height: 400px; flex: 1;">
                    <div id="friendsBar" style="text-align: center; font-size: 20px; color: #405d9b; background-color: #d0d8e4">
                        <?php
                            $image = "../images/default-avatar.png";
                            if (file_exists($userData['profile_image'])){
                                $editor = new ImageEditor();
                                $image = $editor->getThumbProfile($userData['profile_image']);
                            }
                        ?>
                        <img style="width: 150px; border-radius: 50%; border: solid 2px white;" src="<?php echo $image?>">
                        <br>
                        <a style="text-decoration: none; color: #0392ce;" href="profile.php"><?php echo $userData['first_name'] . " " . $userData['last_name'] ?></a>
                    </div>
                </div>

                <!--post area-->
                <div style="min-height: 400px; flex: 2.5; padding: 20px 0 20px 20px;">
                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                        <form method="post" enctype="multipart/form-data">
                            <textarea name="post" placeholder="What's on your mind?"></textarea>
                            <input type="file" name="file">
                            <input id="postButton" type="submit" value="post">
                            <br>
                        </form>
                        <br>
                    </div>

                    <!--Posts-->
                    <div id="postsBar">
                        <?php
                            $DB = new Connection();
                            $user = new User();
                            $editor = new ImageEditor();
                            $followers = $user->getFollowing($_SESSION['showtime_userid'], "user");

                            $followersIds = false;
                            if(is_array($followers)){
                                $followersIds = array_column($followers, "user_id");
                                $followersIds = implode("','", $followersIds);
                            }

                            if($followersIds){
                                $query = "select * from posts where parent = 0 and user_id in('" . $followersIds . "') order by id desc limit 30";
                                $posts = $DB->read($query);
                            }

                            if(isset($posts) && $posts){
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