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
        header("Location: loginPage.php");
        die;
    }

    //posting starts here
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include("changeImage.php");

        if(isset($_POST['firstName'])){
            $settings = new Settings();
            $settings->saveSettings($_POST, $_SESSION['showtime_userid']);
        }elseif (isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['password2'])){
            $settings = new Settings();
            $passError = $settings->changePassword($_POST, $_SESSION['showtime_userid']);
        }
        else {
            $post = new Post();
            $userId = $_SESSION['showtime_userid'];
            $result = $post->createPost($userId, $_POST, $_FILES);

            if ($result == "") {
                header("Location: profile.php");
                die;
            } else {
                echo "<div style='text-align:center; font-size: 12px; color: white; background-color: gray'>";
                echo "<br>The following errors occurred:<br><br>";
                echo $result;
                echo "</div>";
            }
        }
    }
    //Collect user id
    $userId = $userData['user_id'];

    //Collect posts
    $post = new Post();
    $posts = $post->getPosts($userId);

    //Collect friends
    $user = new User();
    $friends = $user->getFollowing($userData['user_id'], "user");

    $editor = new ImageEditor();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/profile.css">
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    </head>

    <body>
        <?php include("header.php") ?>

        <!--Change profile image-->
        <div id="changeProfileImage" class="changeButtons">
            <div class="changePicBox">
                <form method="post" action="profile.php?change=profile" enctype="multipart/form-data">
                    <div class="editDelDiv2">
                        <input type="file" name="file">
                        <input id="postButton" type="submit" value="Change" style="width: 100px;">
                        <br>
                        <div class="centered">
                            <br><br>
                            <?php
                                echo "<img src='$userData[profile_image]' style='max-width: 500px;'>";
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--Change cover image-->
        <div id="changeCoverImage" class="changeButtons">
            <div class="changePicBox">
                <form method="post" action="profile.php?change=cover" enctype="multipart/form-data">
                    <div class="editDelDiv2">
                        <input type="file" name="file">
                        <input id="postButton" type="submit" value="Change" style="width: 100px;">
                        <br>
                        <div class="centered">
                            <br><br>
                            <?php
                                echo "<img src='$userData[cover_image]' style='max-width: 500px;'>";
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--Cover area-->
        <div id="profileMainDiv">
            <div id="topPart">
                <?php
                    $cover = "../images/sea.jpg";
                    if (file_exists($userData['cover_image'])){
                        $cover = $editor->getThumbCover($userData['cover_image']);
                    }
                ?>
                <img src="<?php echo $cover?>" id="coverImage">
                <?php
                    $image = "../images/default-avatar.png";
                    if (file_exists($userData['profile_image'])){
                        $image = $editor->getThumbProfile($userData['profile_image']);
                    }
                ?>
                <div id="overCover">
                    <?php
                        if($userData['user_id'] == $_SESSION['showtime_userid']) {
                            echo '<a href="change_profile_picture.php?change=cover"><button id="changeCover" onclick="showChangeCover(event)">Change cover</button></a>';
                        }
                    ?>
                    <br>
                    <img id="profilePic" src="<?php echo $image?>">
                    <br>
                    <?php
                        if($userData['user_id'] == $_SESSION['showtime_userid']) {
                            echo '<a href="change_profile_picture.php?change=profile"><button id="changeProfile" onclick="showChangeProfile(event)">Change photo</button></a>';
                        }
                    ?>
                </div>
                <div id="personNameDiv">
                    <a id="personName" href="profile.php?id=<?php echo $userData['user_id'] ?>">
                        <?php echo $userData['first_name'] . " " . $userData['last_name'] ?>
                    </a>
                </div>
                <div id="buttonFollowDiv">
                    <a href="like.php?type=user&id=<?php echo $userData['user_id'] ?>">
                        <?php
                        if($userData['user_id'] != $_SESSION['showtime_userid']) {
                            $myId = $_SESSION['showtime_userid'];
                            $user = new User();
                            $following = $user->getFollowing($myId, "user");
                            $iFollow = false;
                            if (is_array($following)){
                                $userIds = array_column($following, "user_id");
                                if (in_array($userData['user_id'], $userIds)){
                                    $iFollow = true;
                                }
                            }
                            if ($iFollow){
                                echo '<input id="followButton" type="button" value="Unfollow">';
                            } else {
                                echo '<input id="followButton" type="button" value="Follow">';
                            }
                        }
                        ?>
                    </a>
                </div>
                <?php
                    if($userData['user_id'] == $_SESSION['showtime_userid']) {
                        echo '<a href="index.php"><div class="menuButtons">Timeline</div></a>';
                    }
                ?>
                <a href="profile.php?section=about&id=<?php echo $userData['user_id'] ?>" ><div class="menuButtons">About</div></a>
                <a href="profile.php?section=followers&id=<?php echo $userData['user_id'] ?>"><div class="menuButtons">Followers</div></a>
                <a href="profile.php?section=following&id=<?php echo $userData['user_id'] ?>"><div class="menuButtons">Following</div></a>
                <a href="profile.php?section=photos&id=<?php echo $userData['user_id'] ?>"><div class="menuButtons">Photos</div></a>
                <?php
                    if($userData['user_id'] == $_SESSION['showtime_userid']) {
                        echo '<a href="profile.php?section=settings&id=' . $userData['user_id'] . '"><div class="menuButtons">Settings</div></a>';
                    }
                ?>
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
                }elseif($section == "about"){
                    include("profile_about.php");
                }elseif($section == "settings"){
                    include("profile_settings.php");
                }
            ?>

        </div>

    </body>

</html>

<script type="text/javascript">
    function showChangeProfile(event){
        event.preventDefault();
        var profileImage = document.getElementById("changeProfileImage");
        profileImage.style.display = "block";
    }

    function hideChangeProfile(){
        var profileImage = document.getElementById("changeProfileImage");
        profileImage.style.display = "none";
    }

    function showChangeCover(event){
        event.preventDefault();
        var coverImage = document.getElementById("changeCoverImage");
        coverImage.style.display = "block";
    }

    function hideChangeCover(){
        var coverImage = document.getElementById("changeCoverImage");
        coverImage.style.display = "none";
    }

    function showChangePassword(event){
        event.preventDefault();
        var profileImage = document.getElementById("changePassword");
        profileImage.style.display = "block";
    }

    window.onkeydown = function (key){
        if(key.keyCode == 27){
            hideChangeProfile();
            hideChangeCover();
        }
    }
</script>