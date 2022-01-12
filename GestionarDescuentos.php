<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>

<body>
    
    <div class="wrapper">  
        <main>
            <style>
                tr td:first-child {
                  border-radius: 15px 0px 0px 15px;
                }
                tr td:last-child  {
                  border-radius: 0px 15px 15px 0px;
                }
              </style>
            <table class="galeria">
            <form action='agregarDescuento.php' method='post'>
                <button type='submit' class='botonProducto' name='ID'>Agregar</button>
            </form> 
           
              <?php
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT D.ID, D.videojuegoID, D.descuento, D.imagen, V.nombre FROM Descuento D, Videojuego V WHERE V.ID=D.videojuegoID");                     
                while($row=mysqli_fetch_assoc($result)){
                  $ID=$row['ID'];
                  $nombre=$row['nombre'];
                  $imagen=$row['imagen'];
                  $videojuegoID=$row['videojuegoID'];
                  $descuento=$row['descuento'];
                  echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' width='50%' bgcolor=#F7F7FE>
                              <td><img class='imgProducto' src='$imagen' alt='$nombre' /></td>
                              <td class='nombreProducto'>$nombre
                              <h4>$descuento%</h4>
                              </td>
                              <td>
                              <form action='EditarDescuento.php?ID=$ID' method='post'>
                                <button type='submit' class='botonProducto' name='ID' id='$ID'>Editar</button>
                              </form> 
                              <form action='EliminarDescuento.php?ID=$ID' method='post'>
                                <button type='submit' class='botonProducto' name='ID' id='$ID'>Eliminar</button>
                              </form> 
                              </td>
                              <td width='20px'></td>
                            </tr>
                          <tr class='espacio'></tr>
                        </div>";
                  
                }
                mysqli_close($conn);
              ?>
            </table>
        </main>

    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
    
</body>

</html>
