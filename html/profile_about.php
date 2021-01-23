<div class="settingsDiv1">
    <div class="settingsDiv2" style="max-width: 500px;">
        <form method="post" enctype="multipart/form-data">
            <?php
                if(isset($userData)) {
                    $settings = new Settings();
                    $settings = $settings->getSettings($userData['user_id']);
                }

                if(is_array($settings)) {
                    echo "<br><p style='color: #0392ce; font-weight: bold;'>About me:</p><br>
                    <div class='aboutTextbox'>".htmlspecialchars($settings['about'])."</div>";
                }
            ?>
        </form>
    </div>
</div>
