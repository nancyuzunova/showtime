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
                            if(is_array($result)){
                                foreach ($result as $row){
                                    $friend_row=$user->getUser($row['user_id']);
                                    include("friend.php");
                                }
                            }else{
                                echo "No results were found";
                            }
                        ?>
                        <br style="clear: both;">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
