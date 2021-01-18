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
        $post = new Post();
        $userId = $_SESSION['showtime_userid'];
        $result = $post->createPost($userId, $_POST, $_FILES);

        if ($result == "") {
            header("Location: singlePost.php?id=$_GET[id]");
            die;
        } else {
            echo "<div style='text-align:center; font-size: 12px; color: white; background-color: gray'>";
            echo "<br>The following errors occurred:<br><br>";
            echo $result;
            echo "</div>";
        }
    }

    $error = "";
    $row = false;
    $post = new Post();
    if (isset($_GET['id']) && is_numeric($_GET['id'])){
        $row = $post->getPostById($_GET['id']);
    } else {
        $error = "No post was found!";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Single post| Show Time</title>
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
                        <?php
                            $user = new User();
                            $editor = new ImageEditor();
                            if(is_array($row)){
                                $row_user = $user->getUser($row['user_id']);
                                include("user_post.php");
                            }
                        ?>
                        <br style="clear: both;">
                        <div class="inForm">
                            <form method="post" enctype="multipart/form-data">
                                <textarea name="post" placeholder="Your comment here."></textarea>
                                <input type="hidden" name="parent" value="<?php echo $row['post_id'] ?>">
                                <input type="file" name="file">
                                <input id="postButton" type="submit" value="post">
                                <br><br>
                            </form>
                        </div>
                        <?php
                            $comments = $post->getComments($row['post_id']);
                            if(is_array($comments)){
                                foreach($comments as $comment){
                                    include("comment.php");
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
