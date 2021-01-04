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
            <div class="signUp">
                    <form class="signUpForm" method="POST" action="register.php">
                        <h2 class="title">Регистрация</h2>
                        <div class="inputField">
                            <i class="fas fa-user"></i>
                            <input value="" name="firstName" type="text" placeholder="Име" />
                        </div>
                        <?php
                        if(isset($resultRegister)){
                            $errors = explode("<br>", $resultRegister);
                            foreach ($errors as $error){
                                if((strpos($error, 'ето име') !== false)){
                                    echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$error</div>";
                                }
                            }
                        }
                        ?>
                        <div class="inputField">
                            <i class="fas fa-user"></i>
                            <input value=""  name="lastName" type="text" placeholder="Фамилия" />
                        </div>
                        <?php
                        if(isset($resultRegister)){
                            $errors = explode("<br>", $resultRegister);
                            foreach ($errors as $error){
                                if((strpos($error, 'фамилия') !== false)){
                                    echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$error</div>";
                                }
                            }
                        }
                        ?>
                        <div class="inputField">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password" placeholder="Парола" />
                        </div>
                        <?php
                        if(isset($resultRegister)){
                            $errors = explode("<br>", $resultRegister);
                            foreach ($errors as $error){
                                if((strpos($error, 'въведете парола') !== false)){
                                    echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$error</div>";
                                }
                            }
                        }
                        ?>
                        <div class="inputField">
                            <i class="fas fa-lock"></i>
                            <input name="password1" type="password" placeholder="Потвърди парола" />
                        </div>
                        <?php
                        if(isset($resultRegister)){
                            $errors = explode("<br>", $resultRegister);
                            foreach ($errors as $error){
                                if((strpos($error, 'повторете') !== false)){
                                    echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$error</div>";
                                }
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
                                    echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$error</div>";
                                    break;
                                }
                            }
                        }
                        ?>
                        <div>
                            <br>
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Мъж</label>&nbsp &nbsp
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Жена</label>&nbsp &nbsp
                            <input type="radio" id="other" name="gender" value="other">
                            <label for="female">Друг</label>
                            <br><br>
                        </div>

                        <button class="button">SIGN UP</button>
                    </form>
            </div>

            <div class="panelDiv">
                <div class="panel right-panel">
                    <div class="content">
                        <h3>Вече сте част от нас?</h3><br>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum laboriosam ad deleniti.</p><br>
                        <button onclick="window.location.href='loginPage.php'" class="button transparent">LOGIN</button>
                    </div>
                    <img src="../images/imgReg.svg" class="image" alt="" />
                </div>
            </div>
        </div>

    </body>
</html>