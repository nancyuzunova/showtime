<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="index.css" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>PhotoMerge</title>
    </head>

    <body>

        <div class="container">
            <div class="forms-container">
                <div class="signin-signup">
                    <form action="#" class="sign-in-form">
                        <h2 class="title">Вход</h2>
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input type="text" placeholder="E-mail" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Парола" />
                        </div>
                
                        <input type="submit" value="Влез" class="btn solid" />
                    </form>

                    <form action="#" class="sign-up-form">
                        <h2 class="title">Регистрация</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Име" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Фамилия" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Парола" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Потвърди парола" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input type="email" placeholder="E-mail" />
                        </div>
                        <div>
                            Пол: 
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Мъж</label><br>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Жена</label><br>
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
                    <img src="../images/imgLog.svg" class="image" alt="" />
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
    
        <script src="app.js"></script>
      </body>
    </html>