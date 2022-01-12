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
                }elseif($_SESSION['Admin']=='1'){
                    echo "<div>Debe ser un usuario cliente</div>";
                }
                else{
                    $nombre=$_SESSION['usuario'];
                    $ID=$_SESSION['ID'];
                    $IDCarrito=$ID;
                    ?>
        <div class="carrito">
                <?php  echo "<h2 class='subtitulos'>Carrito de: $nombre</h2>";?>
            <div class="cont-carrito">
                    <?php
                    echo "<div>Productos:<div/>";
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
                            echo "<div class='text-fact-carrito'>$nombre:₡ $precio</div>
                                  ";

                        }
                        mysqli_close($conn);
                        echo "<div class='text-fact-carrito'><a href='facturacion.php?ID=$IDCarrito' class='btn-carrito'>
                                Finalizar compra
                              </a></div>";
                }
            ?>
            </div>
        </div>
        </main>

    </div>
    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>