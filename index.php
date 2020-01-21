<?php
    session_start();
    //in order to test, click home button to logout - for now;
    $_SESSION['loggedin']=false;
?>

<?php require_once 'inc/header.php'?>
<h1>Welcome to test</h1><br>

<?php require_once 'inc/footer.php'?>