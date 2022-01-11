

<?php 
  if (isset($_POST['nombre'])) {
      include "includes/Conexion.php";
      $conn=conectar();
      $nombre = $_POST['nombre'];
     $select = $_POST['select'];
      $precio = $_POST['precio'];
      $codigo = $_POST['codigo'];
      $sql = "INSERT INTO Videojuego(nombre, codigo, plataformaID, precio, imagen,descripcion)
      VALUES  ('$nombre', '$codigo','$select', '$precio' ,'img/MasterCard.png','Un plataformas en 3D homenaje a los viejos clásicos..');";
        try {
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          header("Location: catalogo-productos-servicios.php");
      } catch (Exception $e) {
          echo 'Error al cargar datos: ',  $e->getMessage(), "\n";
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
          <form class="cont-articulo" action="#" method = "post">
              <div class="row">
                <div class="col-md-12 mb-3"> <label for="nombre">Nombre del videojuego</label>
                  <input type="text" class="form-control" id="nombre" placeholder="Por ejemplo: Final Fantasy X" name="nombre" required="">
                </div>
              </div>
                <div class="row">
                  <div class="col-md-12 mb-3"> <label for="plataforma">Plataforma</label> 
                    <select class="form-control" id="plataforma" required="" name = "select">
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
                <input type="text" class="form-control" id="precio"  name="precio" required="">
            </div>
            </div>
            <div class="row">
            <div> 
                <label for="Codigo">Codigo del videojuego</label>
                <input type="text" class="form-control" id="Codigo"  name="codigo" required="">
            </div>
            </div>
            <div class="rowbtn">
            <button type="submit" class="btn-carrito">Registrarse</button>
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
