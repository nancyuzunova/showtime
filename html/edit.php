<?php
    include("loader.php");

    //check if user is logged in
    if (isset($_SESSION['showtime_userid']) && is_numeric($_SESSION['showtime_userid'])) {
        $user_id = $_SESSION['showtime_userid'];
        $user = new User();
        $user_data = $user->getUser($user_id);
    } else {
        header("Location: login_page.php");
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
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    </head>

    <body>
        <?php include("header.php") ?>

        <!--Cover area-->
        <div id="profileMainDiv">

            <!-- below cover area-->
            <div id="mainContain">
                <!--post area-->
                <div style="min-height: 400px; flex: 2.5; padding: 20px 0 20px 20px;">
                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                        <form method="post" enctype="multipart/form-data">
                            <?php
                            if ($error != "") {
                                echo $error;
                            } else {
                                if ($row) {
                                    echo "Edit post.<br><br>";
                                    echo '<textarea name="post" placeholder="whats on your mind?">'.$row['post'].'</textarea>
                                          <input type="file" name="file">';
                                    echo "<input style='width: 100px' id='postButton' type='submit' value='Save'>";
                                    echo "<input type='hidden' name='postId' value='$row[post_id]'>";

                                    if (file_exists($row['image'])) {
                                        $editor = new ImageEditor();
                                        $postImage = $editor->getThumbPost($row['image']);
                                        echo "<br><br> <div style='text-align: center;'><img src='$postImage' style='width: 50%;'></div>";
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
