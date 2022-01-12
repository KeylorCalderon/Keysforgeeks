<?php
        include "includes/sesionInicio.php";
?>
<?php 
  if (isset($_POST['porcentaje'])) {

    include "includes/Conexion.php";
    $conn=conectar();
    $productoID=$_POST['botonEditar'];
    if(isset($_POST['cambiarImagen']) && $_POST["cambiarImagen"])
    {
        $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
        $max_tamanyo = 1024 * 1024 * 16;
        $ruta_indexphp = dirname(realpath(__FILE__));
        $ruta_fichero_origen = $_FILES['imagen1']['tmp_name'];
        if ( in_array($_FILES['imagen1']['type'], $extensiones) ) {
            //echo 'Es una imagen';
            if ( $_FILES['imagen1']['size']< $max_tamanyo ) {
                //echo 'Pesa menos de 1 MB';
                
                $nombreFichero='img/DescuentoEditado'.$productoID.'.png';
                $ruta_nuevo_destino = $ruta_indexphp . '/' . $nombreFichero;
                if(move_uploaded_file ($ruta_fichero_origen, $ruta_nuevo_destino)){
                    $sql = "UPDATE Descuento SET imagen='$nombreFichero' WHERE ID='$productoID'";
                    mysqli_query($conn, $sql);
                }   
            }
        }
    }
    $precio = $_POST['porcentaje'];
    $sql="UPDATE Descuento SET descuento='$precio' WHERE ID='$productoID'";
    mysqli_query($conn, $sql);
    mysqli_close($conn); 
    echo "<script>location.href='GestionarDescuentos.php';</script>";
    //header("Location: GestionarDescuentos.php");
  }
?>  
<!DOCTYPE html>
<html>
<head>   
  <?php
        include "includes/Encabezado.php";
  ?>
  <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"-->
</head>
<body class="bg-light">
  <div class="wrapper">
    <div class="carrito">
        <div class="col-md-12 order-md-1">

        <?php 
                $descuentoID=$_GET['ID'];
                //echo "<h3>$var</h3>"
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT D.descuento, V.nombre, V.codigo, V.plataformaID, V.precio,
                                            V.imagen, V.descripcion, P.nombre AS plataforma
                                            FROM Videojuego V, Plataforma P, Descuento D
                                            WHERE P.ID=V.plataformaID AND D.ID=' $descuentoID' AND D.videojuegoID=V.ID;");                
                $row=mysqli_fetch_assoc($result);
                $nombre=$row["nombre"];
                $descripcion=$row["descripcion"];
                $codigo=$row["codigo"];
                $precio=$row["precio"];
                $imagen=$row["imagen"];
                $descuento=$row["descuento"];
                $plataforma=$row["plataforma"];
            echo "<h4 class='mb-3'><b>Editar $nombre-$plataforma</b></h4>";
        ?>

          <form class="cont-articulo" action="#" method = "post" enctype="multipart/form-data">
              <div class="row">
                <div>
                    <input type="file" class="inputimg" name="imagen1" />
                    <input type="checkbox" name="cambiarImagen" checked />
                    <label>Cambiar</label>
                </div>
              </div>
                

            <div class="row">
            <div> 
                <label for="precio">Descuento</label>
                <?php
                    echo "<input type='number' min='1' max='99' class='form-control' id='porcentaje' placeholder='$descuento' name='porcentaje' required>";
                ?>
            </div>
            </div>
            
            
            </div>
            <div class="rowbtn">
                <?php
                     echo "<button type='submit' class='btn-carrito' value='$descuentoID' name='botonEditar'>Guardar cambios</button>";
                ?>
            </div>
          </form>
        </div>
    </div>  
  </div>
  <?php
        include "includes/PiePagina.php";
  ?>
  <!--script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" ></script-->
</body>

</html>
