<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>


<body>
    <div class="wrapper">        
        <main>
            <?php
                if(@$_SESSION['usuario']==null || $_SESSION['usuario']==''){
                    echo "<div>Usuario no logueado</div>";
                }else{
                    $nombre=$_SESSION['usuario'];
                    $ID=$_SESSION['ID'];
                    echo "<div>Carrito de: $nombre<div/>";
                        $conn=conectar();
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
                                                    WHERE CXV.ID=precios.ID AND CXV.videojuegoID=V.ID AND CXV.carritoID='$ID'
                                                    ORDER BY ID ASC");                     
                        while($row=mysqli_fetch_assoc($result)){
                            $ID=$row['ID'];
                            $nombre=$row['nombre'];
                            $precio=$row['precio'];
                            echo "<div>$ID</div>
                                  <div>$nombre</div>
                                  <div>$precio</div>";
                        
                        }
                        mysqli_close($conn);
                }
            ?>
        </main>

    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>