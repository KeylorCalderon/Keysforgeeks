<?php
    include "includes/sesionInicio.php";
    if (isset($_POST['motivo'])) {

        $usuarioID=$_SESSION['ID'];
        $facturaID=$_GET['ID'];

        include "includes/Conexion.php";
        $conn=conectar();

        $sql="UPDATE Factura SET estado=0 WHERE ID='$facturaID'";
        mysqli_query($conn, $sql);

        require_once 'lib/nusoap.php';
        include "includes/ServiceCancelarFactura.php";
        $motivo=$_POST['motivo'];

        $resultB=mysqli_query($conn, "SELECT * FROM Llave ORDER BY ID DESC LIMIT 1");  
        $rowB=mysqli_fetch_assoc($resultB);

		$empresa ='EmpresaPruebaWeb';
		$tienda = 'Keysforgeeks';
		$llave = $rowB['llaveTienda'];
        
        $parametros2 = array (  'empresa' => "$empresa",
                                'tienda' => "$tienda",
                                'llave' => "$llave",
                                'factura' => $facturaID,
                                'motivo' => "$motivo");

        $response2 = $client2->call('CancelarVenta', $parametros2);

        echo "<script>location.href='ComprasAnteriores.php';</script>";
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
          <h4 class="mb-3"><b>Dinos el motivo de la cancelación</b></h4>
          <form class="cont-articulo" action="#" method = "post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 mb-3"> <label for="nombre">Motivo de cancelación</label>
                  <input type="text" class="form-control" id="motivo" placeholder="Ya no lo necesito..." name="motivo" required>
                </div>
            <button type="submit" class="btn-carrito">CANCELAR</button>
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