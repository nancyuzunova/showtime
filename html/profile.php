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
        $userId = $_SESSION['showtime_userid'];
        $result = $post->createPost($userId,$_POST, $_FILES);

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
    //Collect user id
    $userId = $userData['user_id'];

    //Collect posts
    $post = new Post();
    $posts = $post->getPosts($userId);

    //Collect friends
    $user = new User();
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
                <div id="personName">
                    <a href="profile.php?id=<?php echo $userData['user_id'] ?>">
                        <?php echo $userData['first_name'] . " " . $userData['last_name'] ?>
                    </a>
                </div>

                <br>
                <a href="like.php?type=user&id=<?php echo $userData['user_id'] ?>">
                    <input id="postButton" type="button" value="Follow <?php echo $userData['likes']?>" style="margin-right: 30px; background-color: #04befe; width: 100px;">
                </a>
                <br>
                <br>
                <a href="index.php" style="text-decoration: none;"><div class="menuButtons">Timeline</div></a>
                <a href="profile.php?section=abouts&id=<?php echo $userData['user_id'] ?>" style="text-decoration: none;"><div class="menuButtons">About</div></a>
                <a href="profile.php?section=followers&id=<?php echo $userData['user_id'] ?>" style="text-decoration: none;"><div class="menuButtons">Followers</div></a>
                <a href="profile.php?section=following&id=<?php echo $userData['user_id'] ?>" style="text-decoration: none;"><div class="menuButtons">Following</div></a>
                <a href="profile.php?section=photos&id=<?php echo $userData['user_id'] ?>" style="text-decoration: none;"><div class="menuButtons">Photos</div></a>
                <a href="profile.php?section=settings" style="text-decoration: none;"><div class="menuButtons">Settings</div></a>
            </div>

            <!-- below cover area-->
            <?php
                $section = "default";
                if(isset($_GET['section'])){
                    $section = $_GET['section'];
                }
                if($section == "default"){
                    include("profile_default.php");
                }elseif($section == "followers"){
                    include("profile_followers.php");
                }elseif($section == "following"){
                    include("profile_following.php");
                }elseif($section == "photos"){
                    include("profile_photos.php");
                }
            ?>

        </div>

    </body>

</html>