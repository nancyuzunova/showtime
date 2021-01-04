<?php
    include("loader.php");

    //check if user is logged in
    if (isset($_SESSION['showtime_userid']) && is_numeric($_SESSION['showtime_userid'])) {
        $user_id = $_SESSION['showtime_userid'];
        $user = new User();
        $user_data = $user->getUser($user_id);
    } else {
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
                        <?php
                            $user = new User();
                            $editor = new ImageEditor();
                            if(is_array($row)){
                                $row_user = $user->getUser($row['user_id']);
                                include("user_post.php");
                            }
                        ?>
                        <br style="clear: both;">
                        <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                            <form method="post" enctype="multipart/form-data">
                                <textarea name="post" placeholder="Your comment here."></textarea>
                                <input type="hidden" name="parent" value="<?php echo $row['post_id'] ?>">
                                <input type="file" name="file">
                                <input id="postButton" type="submit" value="post">
                                <br>
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
