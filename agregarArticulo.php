<?php 
  include "includes/sesionInicio.php";
  if (isset($_POST['nombre'])) {
    $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
    $max_tamanyo = 1024 * 1024 * 16;
    $ruta_indexphp = dirname(realpath(__FILE__));
    $ruta_fichero_origen = $_FILES['imagen1']['tmp_name'];
    if ( in_array($_FILES['imagen1']['type'], $extensiones) ) {
        echo 'Es una imagen';
        if ( $_FILES['imagen1']['size']< $max_tamanyo ) {
              echo 'Pesa menos de 1 MB';
              
              echo 'Fichero guardado con éxito';
                  include "includes/Conexion.php";
                  $conn=conectar();
                  $nombre = $_POST['nombre'];
                  $select = $_POST['select'];
                  $precio = $_POST['precio'];
                  $codigo = $_POST['codigo'];
                  $descripcionVideojuego=$_POST['DescripcionV'];
                  $sql = "INSERT INTO Videojuego(nombre, codigo, plataformaID, precio, imagen,descripcion, activo)
                  VALUES  ('$nombre', '$codigo','$select', '$precio' ,'X','$descripcionVideojuego', 1);";
                    try {
                      mysqli_query($conn, $sql);
                      $ultimo_id = mysqli_insert_id($conn); 
                      $nombreFichero='img/'.$nombre.$ultimo_id.'.png';
                      $ruta_nuevo_destino = $ruta_indexphp . '/' . $nombreFichero;
                      if(move_uploaded_file ($ruta_fichero_origen, $ruta_nuevo_destino)){
                        $sql = "UPDATE Videojuego SET imagen='$nombreFichero' WHERE ID='$ultimo_id'";
                        mysqli_query($conn, $sql);
                        mysqli_close($conn);
                        header("Location: GestionarProductos.php");
                      }
                      echo "<div>Error al cargar la imagen '$ruta_nuevo_destino'</div>";
                  } catch (Exception $e) {
                      echo 'Error al cargar datos: ',  $e->getMessage(), "\n";
                  }
        }
    }
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
          <h4 class="mb-3"><b>¡Agrega un videojuego al catálogo!</b></h4>
          <form class="cont-articulo" action="#" method = "post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12 mb-3"> <label for="nombre">Nombre del videojuego</label>
                  <input type="text" class="form-control" id="nombre" placeholder="Por ejemplo: Final Fantasy X" name="nombre" required>
                </div>
              </div>
              <div class="row">
                <div>
                    <input type="file" class="inputimg" name="imagen1" />
                </div>
              </div>
                <div class="row">
                  <div class="col-md-12 mb-3"> <label for="plataforma">Plataforma</label> 
                    <select class="form-control" id="plataforma" required name = "select">
                        <option value="">Elige...</option>
                        <option value="1">Steam</option>
                        <option value="2">Epic</option>
                        <option value="3">Android</option>
                        <option value="4">PlayStation 4</option>
                        <option value="5">PlayStation 5</option>
                        <option value="6">Xbox One</option>
                        <option value="7">Xbox series</option>
                        <option value="8">Nintendo Switch</option>
                      </select>
                  </div>
              </div>

            <div class="row">
            <div> 
                <label for="precio">Precio del videojuego</label>
                <input type="number" class="form-control" id="precio"  name="precio" min='1' required>
            </div>
            </div>
            <div class="row">
            <div> 
                <label for="Codigo">Codigo del videojuego</label>
                <input type="text" class="form-control" id="Codigo"  name="codigo" required>
            </div>
            </div>
            <div class="row"> 
              <div>
                <label for="DescripcionV">Descripción del videojuego</label>
                <input type="text" class="form-control" id="DescripcionV"  name="DescripcionV" required>
              </div>
            </div>
            </div>
            <div class="rowbtn">
            <button type="submit" class="btn-carrito">¡Agregalo ahora!</button>
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
