<?php
    include "includes/DatosPrueba.php";
    include "includes/Conexion.php";
    $conn=conectar();
    borrarBD($conn);
    crearBD($conn);
    cargarDatos($conn);
    cerrar($conn);
    header("Location: index.php");
?>