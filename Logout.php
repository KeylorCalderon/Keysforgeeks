<?php
    session_start();
    session_destroy();
    //$_SESSION['usuario'] = null;
    header("Location: index.php");
?>