<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/login_page.css" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>Friends | Login Page</title>
    </head>

    <body>
        <div class="container">
            <div class="forms-container">
                <div class="signin-signup">
                    <form class="sign-in-form" method="post" action="login.php">
                        <h2 class="title">Вход</h2>
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input name="email" type="text" placeholder="E-mail" />
                        </div>
                        <?php
                            if(isset($emailError)){
                                echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$emailError</div>";
                            }
                            if(!isset($emailError) && isset($result) && (strpos($result, 'имейл') !== false)){
                                echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$result</div>";
                            }
                        ?>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password" placeholder="Парола" />
                        </div>
                        <?php
                            if(isset($passwordError)){
                                echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$passwordError</div>";
                            }
                            if(!isset($passwordError) && isset($result) && (strpos($result, 'парола') !== false)){
                                echo "<div style='color: #0392ce; font-size: 18px; width: 380px; text-align: center;'>$result</div>";
                            }
                        ?>
                        <input type="submit" value="Влез" class="btn solid" />
                    </form>

                    <form class="sign-up-form" method="POST" action="register.php">
                        <h2 class="title">Регистрация</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input value="" name="first_name" type="text" placeholder="Име" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input value=""  name="last_name" type="text" placeholder="Фамилия" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password" placeholder="Парола" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input name="password1" type="password" placeholder="Потвърди парола" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input value="" name="email" type="email" placeholder="E-mail" />
                        </div>
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

                        <input type="submit" class="btn" value="Регистрация" />
                    </form>
                </div>
            </div>

            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>Все още не сте част от нас?</h3><br>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, ex ratione. Aliquid!</p><br>
                        <button class="btn transparent" id="sign-up-btn">Регистрация</button>
                    </div>
                    <img src="../images/imgLog.svg" width="250px" height="400px" class="image" alt="" />
                </div>
                <div class="panel right-panel">
                    <div class="content">
                        <h3>Вече сте част от нас?</h3><br>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum laboriosam ad deleniti.</p><br>
                        <button class="btn transparent" id="sign-in-btn">Вход</button>
                    </div>
                    <img src="../images/imgReg.svg" class="image" alt="" />
                </div>
            </div>
        </div>

        <script src="../js/app.js"></script>
    </body>
</html>