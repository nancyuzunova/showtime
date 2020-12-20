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

    if (isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "delete.php")) {
        $_SESSION['returnTo'] = $_SERVER['HTTP_REFERER'];
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

    //if something was posted
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $post->deletePost($_POST['postId']);
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
                        <form method="post">
                                <?php
                                if ($error != "") {
                                    echo $error;
                                } else {
                                    if ($row) {
                                        echo "Are you sure you want to delete this post?<br><br>";
                                        $user = new User();
                                        $row_user = $user->getUser($row['user_id']);
                                        include("delete_post.php");

                                        echo "<input style='width: 100px' id='postButton' type='submit' value='Delete'>";
                                        echo "<input type='hidden' name='postId' value='$row[post_id]'>";
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
