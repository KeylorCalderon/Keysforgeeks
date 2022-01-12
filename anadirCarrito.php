<?php
    session_start();
    $usuarioID=$_SESSION['ID'];
    $productoID=$_GET['ID'];
    echo "<div>HOLA: $usuarioID</div>";

    include "includes/Conexion.php";
    $conn=conectar();

    $sql="INSERT INTO CarritoXVideojuego (carritoID, videojuegoID) VALUES ('$usuarioID', '$productoID')";

        try {
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            echo "<script>location.href='carrito.php';</script>";
            //header("Location: carrito.php");
        } catch (Exception $e) {
            echo 'Error al cargar datos: ',  $e->getMessage(), "\n";
        }
?>