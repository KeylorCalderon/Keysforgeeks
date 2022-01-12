<?php
        include "includes/sesionInicio.php";
?>
<?php 
  if (isset($_POST['precio']) || isset($_POST['codigo']) || isset($_POST['cambiarImagen']) || isset($_POST['DescripcionV'])) {

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
            echo 'Es una imagen';
            if ( $_FILES['imagen1']['size']< $max_tamanyo ) {
                echo 'Pesa menos de 1 MB';
                
                $nombreFichero='img/Editado'.$productoID.'.png';
                $ruta_nuevo_destino = $ruta_indexphp . '/' . $nombreFichero;
                if(move_uploaded_file ($ruta_fichero_origen, $ruta_nuevo_destino)){
                    $sql = "UPDATE Videojuego SET imagen='$nombreFichero' WHERE ID='$productoID'";
                    mysqli_query($conn, $sql);
                }   
            }
        }
    }
    if(isset($_POST['cambiarPrecio']) && $_POST["cambiarPrecio"])
    {  
        $precio = $_POST['precio'];
        $sql="UPDATE Videojuego SET precio='$precio' WHERE ID='$productoID'";
        mysqli_query($conn, $sql);
    } 
    if(isset($_POST['cambiarCodigo']) && $_POST["cambiarCodigo"])
    {
        $codigo = $_POST['codigo'];
        $sql="UPDATE Videojuego SET codigo='$codigo' WHERE ID='$productoID'";
        mysqli_query($conn, $sql);
    } 
    if(isset($_POST['cambiarDescripcion']) && $_POST["cambiarDescripcion"])
    {
        $descripcion = $_POST['DescripcionV'];
        $sql="UPDATE Videojuego SET descripcion='$descripcion' WHERE ID='$productoID'";
        mysqli_query($conn, $sql);
    } 
    mysqli_close($conn);
    header("Location: GestionarProductos.php");
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
                $productoID=$_GET['ID'];
                //echo "<h3>$var</h3>"
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT V.ID, V.nombre, V.codigo, V.plataformaID, V.precio,
                                            V.imagen, V.descripcion, P.nombre AS plataforma
                                            FROM Videojuego V, Plataforma P
                                            WHERE P.ID=V.plataformaID AND V.ID='$productoID';");                
                $row=mysqli_fetch_assoc($result);
                $nombre=$row["nombre"];
                $descripcion=$row["descripcion"];
                $codigo=$row["codigo"];
                $precio=$row["precio"];
                $imagen=$row["imagen"];
                $plataformaID=$row["plataformaID"];
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
                <label for="precio">Precio del videojuego</label>
                <?php
                    echo "<input type='number' class='form-control' id='precio' min='1' placeholder='$precio'  name='precio'>";
                ?>
                <input type="checkbox" name="cambiarPrecio" checked />
                <label>Cambiar</label>
            </div>
            </div>
            <div class="row">
            <div> 
                <label for="Codigo">Codigo del videojuego</label>
                <?php
                    echo "<input type='text' class='form-control' id='Codigo' placeholder='$codigo' name='codigo'>";
                ?>
                <input type="checkbox" name="cambiarCodigo" checked />
                <label>Cambiar</label>
            </div>
            </div>
            <div class="row"> 
              <div>
                <label for="DescripcionV">Descripción del videojuego</label>
                <?php
                    echo "<input type='text' class='form-control' id='DescripcionV' placeholder='$descripcion' name='DescripcionV'>";
                ?>
                <input type="checkbox" name="cambiarDescripcion" checked />
                <label>Cambiar</label>
              </div>
            </div>
            </div>
            <div class="rowbtn">
                <?php
                     echo "<button type='submit' class='btn-carrito' value='$productoID' name='botonEditar'>Guardar cambios</button>";
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
