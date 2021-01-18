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

    if(isset($_GET['find'])){
        $find = addslashes($_GET['find']);
        $DB = new Connection();
        $query ="select * from users where first_name like '%$find%' || last_name like '%$find%' limit 30";
        $result = $DB->read($query);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Likes | Show Time</title>
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
                            if(is_array($result)){
                                foreach ($result as $row){
                                    $friend_row=$user->getUser($row['user_id']);
                                    include("friend.php");
                                }
                            }else{
                                echo "No results were found";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
