<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/loginPage.css" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>Friends | Login Page</title>
    </head>

    <body>
        <div class="mainDiv">
            <div class="login">
                <form class="loginForm" method="post" action="login.php">
                    <h1 class="title">Sign in</h1>
                    <div class="inputField">
                        <i class="fas fa-envelope"></i>
                        <input name="email" type="text" placeholder="E-mail" />
                    </div>
                    <?php
                        if(isset($resultLogin)){
                            $errors = explode("<br>", $resultLogin);
                            foreach ($errors as $error){
                                if((strpos($error, 'имейл') !== false)){
                                    echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$error</div>";
                                    break;
                                }
                            }
                        }
                    ?>
                    <div class="inputField">
                        <i class="fas fa-lock"></i>
                        <input name="password" type="password" placeholder="Password" />
                    </div>
                    <?php
                        if(isset($resultLogin)){
                            $errors = explode("<br>", $resultLogin);
                            foreach ($errors as $error){
                                if((strpos($error, 'парола') !== false)){
                                    echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$error</div>";
                                }
                            }
                        }
                    ?>
                    <button class="button">LOGIN</button>
                </form>
            </div>

            <div class="panelDiv">
                <div class="panel">
                    <div class="content">
                        <h3>Still not one of us?</h3><br>
                        <p>Every new friend is a new adventure!<br>Join us now, collect your adventures and turn them into memories!</p><br>
                        <button class="button transparent">SIGN UP</button>
                    </div>
                    <img src="../images/imgLog.svg" width="250px" height="400px" class="image" alt="" >
                </div>
            </div>
        </div>

    </body>
</html>