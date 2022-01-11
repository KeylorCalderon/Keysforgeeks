<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>


<body>
    <div class="wrapper">        
        <main>
                <?php
                    $ID=@$_SESSION['ID'];
                    $conn=conectar();
                    $result=mysqli_query($conn,"SELECT F.ID, F.fecha, F.subtotal
                                                FROM Factura F
                                                WHERE F.carritoID='$ID'");           
                    echo "<div class= 'carrito'>";
                    while($row=mysqli_fetch_assoc($result)){
                        $facturaID=$row['ID'];
                        $fecha=$row['fecha'];
                        $subtotal=$row['subtotal'];
                            echo "<h2 class='subtitulos'>Fecha: $fecha</h2>
                            <div class= 'cont-compras'>";  
                            $result2=mysqli_query($conn,"SELECT FD.nombre, FD.precio
                                                        FROM FacturaDetalle FD
                                                        WHERE FD.facturaID='$facturaID'");
                            while($row2=mysqli_fetch_assoc($result2)){
                                    $nombre=$row2['nombre'];
                                    $precio=$row2['precio'];
                                    echo "<p>Articulo: $nombre</p>"; 
                                    echo "<p>● Precio: ₡ $precio</p>"; 
                                          
                                }
                                echo "<p class = 'text-fact-carrito'>Total: ₡ $subtotal</p></div>";      
                        }
                    echo "</div>";
                    mysqli_close($conn);
                ?>
        </main>

    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>