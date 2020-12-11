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

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        echo "<pre>";
        print_r($_POST);
        print_r($_FILES);
        echo "</pre>";
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
                <div style="min-height: 400px; flex: 2.5; padding: 20px 0 20px 20px;">
                    <form method="post" enctype="multipart/form-data">
                        <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                            <input type="file" name="file">
                            <input id="postButton" type="submit" value="post">
                            <br>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </body>

</html>