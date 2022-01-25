<?php
        include "includes/sesionInicio.php";
?>

<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>
<body>
    <div class="wrapper">        
        <main>
            <?php 
                $fechaInicio=$_GET['fechaInicio'];
                $fechaFin=$_GET['fechaFin'];
                $tipoBusqueda=$_GET['tipo'];
                //echo "<div>$fechaInicio---$fechaFin</div></br>";
                $conn=conectar();
                $result=null; 

                switch ($tipoBusqueda) {
                    case 1:
                        $result=mysqli_query($conn,"SELECT U.email, F.ID, F.fecha, F.subtotal, F.estado
                                                    FROM Factura F, Cliente C, Usuario U
                                                    WHERE F.carritoID=C.ID AND C.ID=U.ID AND F.fecha
                                                    BETWEEN CAST('$fechaInicio' AS DATE) AND
                                                    CAST('$fechaFin' AS DATE)
                                                    ORDER BY F.fecha ASC"); 
                        break;
                    case 2:
                        $result=mysqli_query($conn,"SELECT U.email, F.ID, F.fecha, F.subtotal, F.estado
                                                    FROM Factura F, Cliente C, Usuario U
                                                    WHERE F.carritoID=C.ID AND C.ID=U.ID AND F.estado=1 AND F.fecha
                                                    BETWEEN CAST('$fechaInicio' AS DATE) AND
                                                    CAST('$fechaFin' AS DATE)
                                                    ORDER BY F.fecha ASC"); 
                        break;
                    case 3:
                        $result=mysqli_query($conn,"SELECT U.email, F.ID, F.fecha, F.subtotal, F.estado
                                                    FROM Factura F, Cliente C, Usuario U
                                                    WHERE F.carritoID=C.ID AND C.ID=U.ID AND F.estado=0 AND F.fecha
                                                    BETWEEN CAST('$fechaInicio' AS DATE) AND
                                                    CAST('$fechaFin' AS DATE)
                                                    ORDER BY F.fecha ASC"); 
                        break;
                }
         
                echo "<div class= 'carrito'>";
                while($row=mysqli_fetch_assoc($result)){
                    $facturaID=$row['ID'];
                    $fecha=$row['fecha'];
                    $subtotal=$row['subtotal'];
                    $nombreUsuario=$row['email'];
                    echo "<h2 class='subtitulos'>Fecha: $fecha
                            <div>Cliente: $nombreUsuario</div>";

                    $estado = $row['estado'];
                    if($estado==1){
                        echo "<div>ACTIVA</div>";
                    }else{
                        echo "<div>CANCELADA</div>";
                    }
                    echo "</h2>
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
                    echo "<form class='formulario' method='post' action='verMensajes.php?ID=$facturaID' name='verDetalle' id='verDetalle'>
                              <button type='submit' class='botonLogin' name='verEnDetalle' value='verEnDetalle'>Ver facturas</button>
                          </form>";     
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