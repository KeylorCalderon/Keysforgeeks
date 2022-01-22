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
	$client = new nusoap_client("https://localhost/WSServer/registrar.php?wsdl");
	echo "Iniciando prueba</h3>";
		$name = 'Keysforgeeks';
		$location = 'Cartago, Costa Rica';
		$represent = 'Keylor Calderón';
		$email = 'keycal76@gmail.com';

		$parametros = array ( 'nombre' => "$name",
				      'ubicacion' => "$location",
				      'representante' => "$represent",
				      'correo' => "$email");

		$response = $client->call('RegistrarEmpresa', $parametros);
		if (empty($response))
			echo "No se recibió respuesta del servicio</h3>";
		else {
			echo "Respuesta recibida</h3>";
			foreach ($response as $msg)
				echo "<p>--&gt;$msg&lt;--</p>";
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
                $client = new nusoap_client("https://localhost/WSServer/registrar.php?wsdl");
                if(isset($_POST['llave'])) {
                    $empresa = 'No sé';
                    $llave = $_POST['llave'];
                    $tienda = 'No sé 2';
                    $ubicacion = 'Mi casa';
    
                    $parametros = array ( 'empresa' => "$empresa",
                                  'llave' => "$llave",
                                  'tienda' => "$tienda",
                                  'ubicacion' => "$ubicacion");
    
                    $response = $client->call('RegistrarTienda', $parametros);
                    if (empty($response))
                        echo "No se recibió respuesta del servicio</h3>";
                    else {
                        echo "Respuesta recibida</h3>";
                        foreach ($response as $msg)
                            echo "<p>--&gt;$msg&lt;--</p>";
                    }
    
                    echo '<h2>Solicitud</h2>';
                    echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';				
                    echo '<h2>Respuesta</h2>';
                    echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
                    echo '<h2>Detalle</h2>';
                    echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
                }
		}

		echo '<h2>Solicitud</h2>';
		echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';				
		echo '<h2>Respuesta</h2>';
		echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
		echo '<h2>Detalle</h2>';
		echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';

?>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>