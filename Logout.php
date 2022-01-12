<?php
    session_start();
    session_destroy();
    //$_SESSION['usuario'] = null;
    echo "<script>location.href='index.php';</script>";
    //header("Location: index.php");
?>