<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/signUpPage.css" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>Friends | SignUp Page</title>
    </head>

    <body>
        <div class="mainDiv">
                    <form class="signUpForm" method="POST" action="register.php">
                        <h1 class="title">Sign Up</h1>
                        <div class="inputField">
                            <i class="fas fa-user"></i>
                            <input value="" name="firstName" type="text" placeholder="First Name" />
                        </div>
                        <?php
                        if(isset($resultRegister)){
                            $errors = explode("<br>", $resultRegister);
                            foreach ($errors as $error){
                                if((strpos($error, 'ето име') !== false)){
                                    echo "<div class='errorDiv'>* $error</div>";
                                }
                            }
                        }
                        ?>
                        <div class="inputField">
                            <i class="fas fa-user"></i>
                            <input value=""  name="lastName" type="text" placeholder="Last Name" />
                        </div>
                        <?php
                        if(isset($resultRegister)){
                            $errors = explode("<br>", $resultRegister);
                            foreach ($errors as $error){
                                if((strpos($error, 'фамилия') !== false)){
                                    echo "<div class='errorDiv'>* $error</div>";                                }
                            }
                        }
                        ?>
                        <div class="inputField">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password" placeholder="Password" />
                        </div>
                        <?php
                        if(isset($resultRegister)){
                            $errors = explode("<br>", $resultRegister);
                            foreach ($errors as $error){
                                if((strpos($error, 'въведете парола') !== false)){
                                    echo "<div class='errorDiv'>* $error</div>";                                }
                            }
                        }
                        ?>
                        <div class="inputField">
                            <i class="fas fa-lock"></i>
                            <input name="password1" type="password" placeholder="Confirm Password" />
                        </div>
                        <?php
                        if(isset($resultRegister)){
                            $errors = explode("<br>", $resultRegister);
                            foreach ($errors as $error){
                                if((strpos($error, 'повторете') !== false)){
                                    echo "<div class='errorDiv'>* $error</div>";                                }
                            }
                        }
                        ?>
                        <div class="inputField">
                            <i class="fas fa-envelope"></i>
                            <input value="" name="email" type="email" placeholder="E-mail" />
                        </div>
                        <?php
                        if(isset($resultRegister)){
                            $errors = explode("<br>", $resultRegister);
                            foreach ($errors as $error){
                                if((strpos($error, 'имейл') !== false)){
                                    echo "<div class='errorDiv'>* $error</div>";                                    break;
                                }
                            }
                        }
                        ?>
                        <div>
                            <br>
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label>&nbsp &nbsp
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>&nbsp &nbsp
                            <input type="radio" id="other" name="gender" value="other">
                            <label for="female">Other</label>
                            <br><br>
                        </div>

                        <button class="button">SIGN UP</button>
                    </form>
            <div class="panelDiv">
                <div class="panel right-panel">
                    <div class="content">
                        <h1 class="title1">One of us?</h1><br>
                        <p>Building an online community is not an event, it is an ongoing process.</p><br>
                        <button onclick="window.location.href='loginPage.php'" class="button transparent">Sign in</button>
                    </div>
                    <img src="../images/imgReg.svg" class="image" alt="" />
                </div>
            </div>
        </div>

    </body>
</html>