<?php
    include "includes/Conexion.php";
    $conn=conectar();

    for ($i = 1; $i<=101; $i++) {
        $estado=1;
        if($i>=71){
            $estado=0;
        }
        $carrito=rand(1, 3);
        $subtotal=rand(10000, 300000);
        $fecha=date("Y-m-d", mt_rand(1641016800, 1643522400));
        
        $sql = "INSERT INTO Factura(carritoID, fecha, subtotal, estado)
        VALUES  ('$carrito','$fecha', '$subtotal', '$estado');";
        $conn->query($sql);

        $ultimo_id = mysqli_insert_id($conn);

        $cantItems=rand(3, 15);
        for ($j = 1; $j<=$cantItems; $j++) {
            $precio=rand(4000, 60000);

            $videojuegoID=rand(1, 22);
            $plataformaResult=mysqli_query($conn, "SELECT * FROM Videojuego WHERE ID='$videojuegoID'");
            $rowP=mysqli_fetch_assoc($plataformaResult);
            $videojuego=$rowP['nombre'];

            $sql = "INSERT INTO FacturaDetalle(facturaID, nombre, precio)
            VALUES  ('$ultimo_id','$videojuego', '$precio');";
            $conn->query($sql);
        }
    }

    
    mysqli_close($conn);
    echo "<script>location.href='index.php';</script>";
?>