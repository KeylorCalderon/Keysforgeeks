<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>

<body>
 
    <?php
           include "includes/banner.php";
    ?>
    
    <?php
            include "includes/anuncios.php";
    ?>
    
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
              <?php
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT * FROM Videojuego WHERE activo=1");                     
                while($row=mysqli_fetch_assoc($result)){
                  $ID=$row['ID'];
                  $nombre=$row['nombre'];
                  $imagen=$row['imagen'];
                  $descripcion=$row['descripcion'];
                  $precio=$row['precio'];
                  $plataformaID=$row['plataformaID'];
                  echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' width='50%' bgcolor=#F7F7FE>
                              <td><img class='imgProducto' src='$imagen' alt='$descripcion' /></td>
                              <td class='nombreProducto'>$nombre";
                  $plataformaResult=mysqli_query($conn, "SELECT * FROM Plataforma WHERE ID='$plataformaID'");
                  $rowP=mysqli_fetch_assoc($plataformaResult);
                  $plataforma=$rowP['nombre'];
                  echo          "<h4>$plataforma</h4>
                              </td>
                              <td>
                              <form action='producto.php?ID=$ID' method='post'>";
                  $result2=mysqli_query($conn, "SELECT * FROM Descuento WHERE videojuegoID='$ID'"); 
                  if($row2=mysqli_fetch_assoc($result2)){
                    $descuento=$row2['descuento'];
                    echo "<div class='nombreProductoDescuento'>¡$descuento% de descuento!</div>";
                    $precioRebajado=$precio-($precio*$descuento/100);
                    echo "<button type='submit' class='botonProducto' name='ID' id='$ID'>₡$precioRebajado</button>";
                  }else{
                    echo "<button type='submit' class='botonProducto' name='ID' id='$ID'>₡$precio</button>";
                  }
                  echo       "</form> 
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
