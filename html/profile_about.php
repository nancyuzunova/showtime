<div style="min-height: 400px; width: 100%; background-color: white; text-align: center;">
    <div style="padding: 20px; max-width: 500px; display: inline-block;">
        <form method="post" enctype="multipart/form-data">
            <?php
                if(isset($userData)) {
                    $settings = new Settings();
                    $settings = $settings->getSettings($userData['user_id']);
                }

                if(is_array($settings)) {
                    echo "<br><p style='color: #0392ce; font-weight: bold;'>About me:</p><br>
                    <div id='textbox' style='font-family:Snell Roundhand, cursive; height: 300px; width: 300px;border-radius:10px; padding: 7px; border:solid 2px #0392ce; font-size:14px;'>".htmlspecialchars($settings['about'])."</div>";
                }
            ?>
        </form>
    </div>
</div>
