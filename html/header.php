<!--Page top bar-->
<?php
    $headerImage = "../images/default-avatar.png";
    if(isset($userData)){
        $headerImage = $userData['profile_image'];
    }
?>

<div id="topBar">
    <div id="inTopBar">
        <a style="color: white; text-decoration: none;" href="timeline.php">myBook</a>&nbsp &nbsp &nbsp<input type="text" id="searchBox" placeholder="Други потребители">
        <a href="logout.php">
            <span style="font-size:11px; color: white; float: right; margin: 10px;">Изход</span>
        </a>
        <a href="profile.php" style="text-decoration: none;">
            <img src="<?php echo $headerImage ?>" style="width: 50px; float: right; border-radius:50%;">
        </a>
    </div>
</div>