<?php
        include "includes/sesionInicio.php";
?>

<!DOCTYPE html>
<html lang="en">


<?php
        include "includes/Encabezado.php";
?>


<body>
<?php
	require_once 'lib/nusoap.php';
	$client = new nusoap_client("http://localhost/WSServer/registrar.php?wsdl");
		$name = 'EmpresaPruebaWeb';
		$location = 'Calle 11, Avenida 12., 3 km norte del parque central., Provincia de Cartago, Cartago, 30101';
		$represent = 'Keylor Calderón';
		$email = 'elison1606@gmail.com';
		$parametros = array ( 'nombre' => "$name",
				      'ubicacion' => "$location",
				      'representante' => "$represent",
				      'correo' => "$email");
		$response = $client->call('RegistrarEmpresa', $parametros);
		if (empty($response))
			echo "No se recibió respuesta del servicio</h3>";
		else {
            ?>
            <form class="form-inline" action="" method="POST">
                <div class="form-group">
                    <label for="location">Llave</label>
                    <input type="text" name="llave" class="form-control"  placeholder="Llave de autenticación de la empresa" required/>
                </div>
                <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>

                <?php
                require_once 'lib/nusoap.php';
                $client = new nusoap_client("http://localhost/WSServer/registrar.php?wsdl");
                if(isset($_POST['llave'])) {
                    $empresa = 'EmpresaPruebaWeb';
                    $llave = $_POST['llave'];

                    $conn=conectar();
                    $sql="INSERT INTO Llave(llaveCodigo) VALUES ('$llave')";
                    mysqli_query($conn, $sql);
                    mysqli_close($conn);

                    $tienda = 'Keysforgeeks';
                    $ubicacion = 'Calle 15, Avenida 14., 1 km Sur de la Basílica de los Ángeles., Provincia de Cartago, Cartago, 30101';
    
                    $parametros = array ( 'empresa' => "$empresa",
                                  'llave' => "$llave",
                                  'tienda' => "$tienda",
                                  'ubicacion' => "$ubicacion");
                    $response = $client->call('RegistrarTienda', $parametros);
                    if (empty($response))
                        echo "No se recibió respuesta del servicio</h3>";
                    else{
                        echo "<script>location.href='index.php';</script>";
                    }
                }
		}
?>
<?php
    include "includes/PiePagina.php";
?>
</body>
</html>