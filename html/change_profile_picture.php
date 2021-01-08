<?php
    session_start();
    include("loader.php");

    //check if user is logged in
    if(isset($_SESSION['showtime_userid']) && is_numeric($_SESSION['showtime_userid'])){
        $userId = $_SESSION['showtime_userid'];
        $user = new User();
        $userData = $user->getUser($userId);
    }else{
        header("Location: loginPage.php");
        die;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            if ($_FILES['file']['type'] == "image/jpeg") {
                $allowedSize = 1024 * 1024 * 7; // 7 MB
                if ($_FILES['file']['size'] <= $allowedSize) {
                    //create a folder for each user
                    $folder = "../uploads/" . $userId . "/";
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    $editor = new ImageEditor();
                    $filename = $folder . $_FILES['file']['name'] . date("Y-m-d H-i-s") . ".jpg";
                    move_uploaded_file($_FILES['file']['tmp_name'], $filename);

                    $change = "profile";
                    if (isset($_GET['change'])) {
                        $change = $_GET['change'];
                    }
                    if ($change == "cover") {
                        if (file_exists($userData['cover_image'])) {
                            unlink($userData['cover_image']);
                        }
                        $editor->resizeImage($filename, $filename, 1500, 1500);
                    } else {
                        if (file_exists($userData['profile_image'])) {
                            unlink($userData['profile_image']);
                        }
                        $editor->resizeImage($filename, $filename, 1500, 1500);
                    }

                    if (file_exists($filename)) {
                        if ($change == "cover") {
                            $query = "update users set cover_image = '$filename' where user_id = $userId";
                            $_POST['is_cover_image'] = 1;
                        } else {
                            $query = "update users set profile_image = '$filename' where user_id = $userId";
                            $_POST['is_profile_image'] = 1;
                        }
                        $connection = new Connection();
                        $connection->write($query);

                        //create a post
                        $post = new Post();
                        $post->createPost($userId, $_POST, $filename);

                        header("Location: profile.php");
                        die();
                    }
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Change profile image</title>
        <link rel="stylesheet" href="../css/profile.css">
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    </head>

    <body>
        <?php include("header.php") ?>
        <!--Cover area-->
        <div id="profileMainDiv">
            <!-- below cover area-->
            <div id="mainContain">
                <!--post area-->
                <div class="postArea">
                    <form method="post" enctype="multipart/form-data">
                        <divt class="inForm">
                            <input type="file" name="file">
                            <input id="postButton" type="submit" value="Change" style="width: 100px;">
                            <br>
                            <div class="centered">
                                <br><br>
                                <?php
                                    if (isset($_GET['change']) && $_GET['change'] == "cover"){
                                        $change = "cover";
                                        echo "<img src='$userData[cover_image]' style='max-width: 500px;'>";
                                    }else{
                                        echo "<img src='$userData[profile_image]' style='max-width: 500px;'>";
                                    }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>