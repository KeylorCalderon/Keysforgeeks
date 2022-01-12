<?php
    $descuentoID = $_GET['ID'];
    include "includes/Conexion.php";
    $conn=conectar();

    $sql="DELETE FROM Descuento WHERE ID='$descuentoID'";
    mysqli_query($conn, $sql);        

    mysqli_close($conn);
    header("Location: GestionarDescuentos.php");
?>