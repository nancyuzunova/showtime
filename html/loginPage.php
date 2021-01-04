<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/loginPage.css" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>Friends | Sign in</title>
    </head>

    <body>
        <div class="mainDiv">
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
                            if((strpos($error, 'email') !== false)){
                                echo "<div class='errorDiv'>* $error</div>";
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
                            if((strpos($error, 'password') !== false)){
                                echo "<div class='errorDiv'> * $error</div>";
                                break;
                            }
                        }
                    }
                ?>
                <button class="button">Sign in</button>
            </form>

            <div class="panelDiv">
                <div class="panel">
                    <div class="content">
                        <h1 class="title1">New here?</h1><br>
                        <p>Every new friend is a new adventure!<br>Join us now, collect your adventures and turn them into memories!</p><br>
                        <button onclick="window.location.href='signUpPage.php'" class="button transparent">Sign up</button>
                    </div>
                    <img src="../images/imgLog.svg" class="image" alt="" >
                </div>
            </div>
        </div>

    </body>
</html>