<?php
    require('config/config.php');
    require('config/db.php');
    
    session_name('userDaxPlatform');
    session_start();
    session_destroy();

    header('Location: '.ROOT_URL.'');
?>