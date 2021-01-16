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

    $error = "";
    $post = new Post();
    if (isset($_GET['id']) && is_numeric($_GET['id'])){
        $row = $post->getPostById($_GET['id']);
        if (!$row){
            $error = "No such post was found!";
        } else {
            if ($row['user_id'] != $_SESSION['showtime_userid']){
                $error = "Access denied!";
            }
        }
    } else {
        $error = "No such post was found!";
    }

    $_SESSION['returnTo'] = "profile.php";
    if (isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit.php")) {
        $_SESSION['returnTo'] = $_SERVER['HTTP_REFERER'];
    }

    //if something was posted
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $post->editPost($_POST, $_FILES);

        header("Location: " . $_SESSION['returnTo']);
        die;
    }
?>

<!DOCTYPE html>
    <html>
    <head>
        <title>Delete | Show Time</title>
        <link rel="stylesheet" href="../css/profile.css">
        <link rel="stylesheet" href="../css/header.css">
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    </head>

    <body>
        <?php include("header.php") ?>

        <!--Cover area-->
        <div id="profileMainDiv">

            <!-- below cover area-->
            <div id="mainContain">
                <!--post area-->
                <div class="editDelDiv1">
                    <div class="editDelDiv2">
                        <form method="post" enctype="multipart/form-data">
                            <?php
                                if ($error != "") {
                                    echo $error;
                                } else {
                                    if ($row) {
                                        echo "Edit post.<br><br>";
                                        echo '<textarea name="post" placeholder="whats on your mind?">'.$row['post'].'</textarea>
                                              <input type="file" name="file">';
                                        echo "<input class='fullWidth' id='postButton' type='submit' value='Save'>";
                                        echo "<input type='hidden' name='postId' value='$row[post_id]'>";

                                        if (file_exists($row['image'])) {
                                            $editor = new ImageEditor();
                                            $postImage = $editor->getThumbPost($row['image']);
                                            echo "<br><br> <div class='centered'><img src='$postImage' style='width: 50%;'></div>";
                                        }
                                    }
                                }
                            ?>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
