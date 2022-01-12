<?php 
  include "includes/sesionInicio.php";
  if (isset($_POST['porcentaje'])) {
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
                  $porcentaje = $_POST['porcentaje'];
                  $juego = $_POST['select'];
                  $sql = "INSERT INTO Descuento(videojuegoID, descuento, imagen)
                  VALUES  ('$juego', '$porcentaje','X');";
                    try {
                      mysqli_query($conn, $sql);
                      $ultimo_id = mysqli_insert_id($conn); 
                      $nombreFichero='img/Descuento'.$ultimo_id.'.png';
                      $ruta_nuevo_destino = $ruta_indexphp . '/' . $nombreFichero;
                      if(move_uploaded_file ($ruta_fichero_origen, $ruta_nuevo_destino)){
                        $sql = "UPDATE Descuento SET imagen='$nombreFichero' WHERE ID='$ultimo_id'";
                        mysqli_query($conn, $sql);
                        mysqli_close($conn);
                        header("Location: GestionarDescuentos.php");
                      }else{
                        echo "<div>Error al cargar la imagen '$ruta_nuevo_destino'</div>";
                      }
                      
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
          <h4 class="mb-3"><b>¡Agrega un descuento a un videojuego!</b></h4>
          <form class="cont-articulo" action="#" method = "post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12 mb-3"> <label for="nombre">Porcentaje de descuento</label>
                  <input type="number" min="1" max="99" class="form-control" id="porcentaje" placeholder="Por ejemplo: 1-90" name="porcentaje" required>
                </div>
              </div>
              <div class="row">
                <div>
                    <input type="file" class="inputimg" name="imagen1" />
                </div>
              </div>
                <div class="row">
                  <div class="col-md-12 mb-3"> <label for="plataforma">Videojuego</label> 
                    <select class="form-control" id="plataforma" required name = "select">
                        <option value="">Elige...</option>
                        <?php
                            $conn=conectar();
                            $result=mysqli_query($conn, "SELECT V.ID, V.nombre, P.nombre AS plataforma
                                                        FROM Videojuego V, Plataforma P
                                                        WHERE V.activo=1 AND P.ID=V.plataformaID
                                                        AND V.ID NOT IN
                                                        (
                                                            SELECT D.videojuegoID
                                                            FROM Descuento D
                                                        )
                                                        ORDER BY V.ID ASC");                     
                            while($row=mysqli_fetch_assoc($result)){
                                $ID=$row['ID'];
                                $nombre=$row['nombre'];
                                $plataforma=$row['plataforma'];
                                echo "<option value='$ID'>$nombre-$plataforma</option>";
                            }
                            mysqli_close($conn);
                        ?>
                        
                      </select>
                  </div>
              </div>

            
            </div>
            <div class="rowbtn">
            <button type="submit" class="btn-carrito">Agregar</button>
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
