<?php
        include "includes/sesionInicio.php";
?>
<?php
    $carritoID = $_GET['ID'];
    echo "<div>HOLA: $ID</div>";

    include "includes/Conexion.php";
    $conn=conectar();

    $sql="INSERT INTO Factura(carritoID, fecha, subtotal, estado) VALUES ('$carritoID', CURDATE(), 0, 1)";

        try {
            mysqli_query($conn, $sql);
            $ultimo_id = mysqli_insert_id($conn);

            $result=mysqli_query($conn, "SELECT CXV.ID, V.nombre, precios.precio 
                                                    FROM CarritoXVideojuego CXV, Videojuego V,(
                                                        SELECT CXV.ID, (V.precio-(V.precio*D.descuento/100)) AS precio
                                                        FROM CarritoXVideojuego CXV, Videojuego V, Descuento D
                                                        WHERE CXV.videojuegoID=V.ID AND V.ID=D.videojuegoID
                                                        
                                                        UNION ALL
                                                    
                                                        SELECT CXV.ID, V.precio
                                                        FROM CarritoXVideojuego CXV, Videojuego V
                                                        WHERE CXV.videojuegoID=V.ID AND V.ID NOT IN
                                                        (
                                                            SELECT D.videojuegoID
                                                            FROM Descuento D
                                                        )
                                                    )  AS precios
                                                    WHERE CXV.ID=precios.ID AND CXV.videojuegoID=V.ID AND CXV.carritoID='$carritoID'
                                                    ORDER BY ID ASC");                     
            while($row=mysqli_fetch_assoc($result)){
                  $nombre=$row['nombre'];
                  $precio=$row['precio'];
                  $sql="INSERT INTO FacturaDetalle(facturaID, nombre, precio) VALUES ('$ultimo_id', '$nombre', '$precio')";
                  mysqli_query($conn, $sql);
            }
            $result=mysqli_query($conn, "SELECT SUM(FD.precio) AS Total FROM FacturaDetalle FD WHERE FD.facturaID='$ultimo_id'");  
            $row=mysqli_fetch_assoc($result);
            $totalF=$row['Total'];

            $sql="UPDATE Factura SET subtotal='$totalF' WHERE ID='$ultimo_id'";
            mysqli_query($conn, $sql);

            $sql="DELETE FROM CarritoXVideojuego WHERE carritoID='$carritoID'";
            mysqli_query($conn, $sql);
            

            mysqli_close($conn);
            echo "<script>location.href='carrito.php';</script>";
            //header("Location: carrito.php");
        } catch (Exception $e) {
            echo 'Error al cargar datos: ',  $e->getMessage(), "\n";
        }
?>