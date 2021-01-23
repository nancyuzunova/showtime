<div class="settingsDiv1">
    <div class="settingsDiv2">

        <form method="post" enctype="multipart/form-data">
            <?php
                $settings = new Settings();
                $settings = $settings->getSettings($_SESSION['showtime_userid']);

                if(is_array($settings)) {
                    echo "<input type='text' id='textbox' name='firstName' value='". htmlspecialchars($settings['first_name'])."' placeholder='First name' >";
                    echo "<input type='text' id='textbox' name='lastName' value='". htmlspecialchars($settings['last_name'])."' placeholder='Last name' >";
                    echo "<input type='text' id='textbox' name='email' value='". htmlspecialchars($settings['email'])."' placeholder='Email' >";
                    echo "<br>About me:<br>
                            <textarea id='textbox' style='height: 200px;' name='about'>".htmlspecialchars($settings['about'])."</textarea>";
                    echo '<input id="postButton" type="submit" value="Save">';
                }
            ?>
        </form>

        <br><br><br>Change password:
        <form method="post" enctype="multipart/form-data">
            <?php
                $settings = new Settings();
                $settings = $settings->getSettings($_SESSION['showtime_userid']);
                if(is_array($settings)) {
                    echo "<input type='password' id='textbox' name='password' placeholder='Old password'>";
                    if(isset($passError)){
                        $errors = explode("<br>", $passError);
                        foreach ($errors as $error){
                            if((strpos($error, 'Wrong') !== false)){
                                echo "<div class='errorDiv'>* $error</div>";
                                break;
                            }
                        }
                    }
                    echo "<input type='password' id='textbox' name='password1' placeholder='New password'>";
                    if(isset($passError)){
                        $errors = explode("<br>", $passError);
                        foreach ($errors as $error){
                            if((strpos($error, 'contain') !== false)){
                                echo "<div class='errorDiv'>* $error</div>";
                                break;
                            }
                        }
                    }
                    echo "<input type='password' id='textbox' name='password2' placeholder='Confirm new password'>";
                    if(isset($passError)){
                        $errors = explode("<br>", $passError);
                        foreach ($errors as $error){
                            if((strpos($error, 'confirm') !== false)){
                                echo "<div class='errorDiv'>* $error</div>";
                                break;
                            }
                        }
                    }
                    echo"<input style='margin-left: 10px' type='submit' id='changePassword' value='Save password'>";
                }
            ?>
        </form>
    </div>
</div>
