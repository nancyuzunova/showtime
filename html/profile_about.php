<div style="min-height: 400px; width: 100%; background-color: white; text-align: center;">
    <div style="padding: 20px; max-width: 350px; display: inline-block;">
        <style>
            #textbox{
                width:100%; height:20px; border-radius:5px; border:solid 1px grey; padding:4px; margin: 10px; font-size:14px;
            }
        </style>

        <form method="post" enctype="multipart/form-data">
            <?php
                $settings = new Settings();
                $settings = $settings->getSettings($_SESSION['showtime_userid']);

                if(is_array($settings)) {
                    echo "<br>About me:<br>
                                <div id='textbox' style='height: 200px;'>".htmlspecialchars($settings['about'])."</div>";
                }
            ?>
        </form>
    </div>
</div>
