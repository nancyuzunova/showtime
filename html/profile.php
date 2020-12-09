<?php
    session_start();
    print_r($_SESSION);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="../css/profile.css">
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    </head>

    <body>
        <!--Page top bar-->
        <div id="topBar">
            <div id="inTopBar">
                myBook &nbsp &nbsp &nbsp<input type="text" id="searchBox" placeholder="Други потребители">
                <img src="../images/user.jpg" style="width: 50px; float: right; border-radius:50%;">
            </div>
        </div>

        <!--Cover area-->
        <div id="profileMainDiv">
            <div id="mainDivBackground">
                <img src="../images/sea.jpg" style="width:100%;">
                <img id="profilePic" src="../images/user.jpg">
                <br>
                <div id="personName">Мария Петрова</div>
                <br>
                <div class="menuButtons">Timeline</div> 
                <div class="menuButtons">About</div> 
                <div class="menuButtons">Friends</div>
                <div class="menuButtons">Photos</div>
                <div class="menuButtons">Settings</div>
            </div>

            <!-- below cover area-->
            <div id="mainContain">

                <!--friends area-->
                <div style="min-height: 400px; flex: 1;">
                    <div id="friendsBar">
                        Friends<br>
                        <div id="friends">
                            <img id="friendsImg" src="../images/user1.jpg">
                            <br>
                            Мери Пери
                        </div>
                        <div id="friends">
                            <img id="friendsImg" src="../images/user1.jpg">
                            <br>
                            Мери Пери
                        </div>
                        <div id="friends">
                            <img id="friendsImg" src="../images/user1.jpg">
                            <br>
                            Мери Пери
                        </div>
                        <div id="friends">
                            <img id="friendsImg" src="../images/user1.jpg">
                            <br>
                            Мери Пери
                        </div>
                    </div>
                </div>

                <!--post area-->
                <div style="min-height: 400px; flex: 2.5; padding: 20px 0 20px 20px;">
                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                        <textarea placeholder="whats on your mind?"></textarea>
                        <input id="postButton" type="submit" value="post">
                        <br>
                    </div>

                    <!--Posts-->
                    <div id="postsBar">
                    <div id="post">
                            <div>
                                <img src="../images/user1.jpg" style="width: 75px; margin-right: 4px;">
                            </div>
                            <div>
                                <div style="font-weight: bold; color: #405b9d;">First Guy</div>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                <br><br>
                                <a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">December 7 2020</span>
                            </div>
                        </div>
                        <div id="post">
                            <div>
                                <img src="../images/user1.jpg" style="width: 75px; margin-right: 4px;">
                            </div>
                            <div>
                                <div style="font-weight: bold; color: #405b9d;">First Guy</div>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                <br><br>
                                <a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">December 7 2020</span>
                            </div>
                        </div>
                        <div id="post">
                            <div>
                                <img src="../images/user1.jpg" style="width: 75px; margin-right: 4px;">
                            </div>
                            <div>
                                <div style="font-weight: bold; color: #405b9d;">First Guy</div>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                <br><br>
                                <a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">December 7 2020</span>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>

    </body>

</html>