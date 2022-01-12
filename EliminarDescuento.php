<?php
    $descuentoID = $_GET['ID'];
    include "includes/Conexion.php";
    $conn=conectar();

    $sql="DELETE FROM Descuento WHERE ID='$descuentoID'";
    mysqli_query($conn, $sql);        

    mysqli_close($conn);
    echo "<script>location.href='GestionarDescuentos.php';</script>";
    //header("Location: GestionarDescuentos.php");
?>