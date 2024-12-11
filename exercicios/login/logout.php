<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie("usuario", "", time() - 3600, "/"); // Remove cookie
    header('location: index.php?msg=logout');
    exit();
?>
