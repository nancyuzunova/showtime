<?php
    session_start();
    include("Connection.php");
    include("Logging.php");
    include("User.php");
    include("Post.php");

    if(isset($_SESSION['showtime_userid']) && is_numeric($_SESSION['showtime_userid'])){
        $userId = $_SESSION['showtime_userid'];
        $user = new User();
        $userData = $user->getUser($userId);
    }else{
        header("Location: login_page.php");
        die;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            if ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png"){
                $allowedSize = 1024 * 1024 * 7; // 7 MB
                if ($_FILES['file']['size'] <= $allowedSize){
                    $filename = "../uploads/" . $_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], $filename);

                    if (file_exists($filename)){
                        $query = "update users set profile_image = '$filename' where user_id = $userId";
                        $connection = new Connection();
                        $connection->write($query);

                        header("Location: profile.php");
                        die();
                    }
                } else {
                    displayErrorMessage("Only images of size 7 MB or lower are allowed!");
                }
            } else {
                displayErrorMessage("Only images of JPEG or PNG type are allowed!");
            }
        } else {
            displayErrorMessage("Please add a valid image!");
        }
    }

    function displayErrorMessage($message){
        echo "<div style='text-align:center; font-size: 12px; color: white; background-color: gray'>";
        echo "<br>The following errors occurred:<br><br>";
        echo $message;
        echo "</div>";
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
                            <input id="postButton" type="submit" value="Change" style="width: 100px;">
                            <br>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </body>

</html>