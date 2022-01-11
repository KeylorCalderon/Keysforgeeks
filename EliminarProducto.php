<?php
    $productoID = $_GET['ID'];
    include "includes/Conexion.php";
    $conn=conectar();

    $sql="UPDATE Videojuego SET activo=0 WHERE ID='$productoID'";
    mysqli_query($conn, $sql);        

    mysqli_close($conn);
    header("Location: GestionarProductos.php");
?>