<!--Page top bar-->
<?php
    $headerImage = "../images/default-avatar.png";
    if(isset($userData) && isset($USER) && file_exists($USER['profile_image'])){
        $editor = new ImageEditor();
        $headerImage = $editor->getThumbProfile($USER['profile_image']);
    }
?>

<div id="topBar">
    <form method="get" action="search.php">
        <div id="inTopBar">
            <a id="headerLogo" href="index.php">FRIENDS</a>
            <input type="text" id="searchBox" name="find" placeholder="Search for other users">
            <a id="headerLogout" href="logout.php">Logout</a>
            <a href="profile.php">
                <img src="<?php echo $headerImage ?>" id="headerImage">
            </a>
        </div>
    </form>
</div>