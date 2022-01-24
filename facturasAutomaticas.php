<?php
    include "includes/Conexion.php";
    $conn=conectar();

    for ($i = 1; $i<=101; $i++) {
        $estado=1;
        if($i>=71){
            $estado=0;
        }
        $carrito=rand(1, 3);
        $fecha1=date("Y-m-d", mt_rand(1641016800, 1643522400));

        $sql = "INSERT INTO Factura(carritoID, fecha, subtotal, estado)
        VALUES  ('$carrito','$fecha1', 0, '$estado');";
        $conn->query($sql);

        $ultimo_id = mysqli_insert_id($conn);

        include "includes/ServiceCrearFactura.php";
			
        $result=mysqli_query($conn, "SELECT * FROM Llave ORDER BY ID DESC LIMIT 1");  
        $row=mysqli_fetch_assoc($result);

		$empresa ='EmpresaPruebaWeb';
		$tienda = 'Keysforgeeks';
		$llave = $row['llaveTienda'];
		$numero = $ultimo_id;
				
		$items = array ();
		$subtotal = 0;
		$impuestos = 0;

        $cantItems=rand(3, 15);
        for ($j = 1; $j<=$cantItems; $j++) {

            $videojuegoID=rand(1, 22);
            $plataformaResult=mysqli_query($conn, "SELECT * FROM Videojuego WHERE ID='$videojuegoID'");
            $rowP=mysqli_fetch_assoc($plataformaResult);
            $videojuego=$rowP['nombre'];
            $unitario = $rowP['precio'];
			$categoriaID = $rowP['plataformaID'];
            $descripcion = $rowP['descripcion'];
            $categoria= 1;
            
            $sql = "INSERT INTO FacturaDetalle(facturaID, nombre, precio)
            VALUES  ('$ultimo_id','$videojuego', '$unitario');";
            $conn->query($sql);

            $codigo = mysqli_insert_id($conn);
			$cantidad = rand(1, 5);
            $descripcion = substr ( $descripcion, 0, 100);

			$item = array (	'codigo' => "$codigo",
							'descripcion' => "$descripcion",
							'cantidad' => "$cantidad",
							'unitario' => "$unitario",
							'categoria' => "$categoria");
			array_push ($items, $item);
					
			$subtotal += $unitario * $cantidad;
        }
        $sql="UPDATE Factura SET subtotal='$subtotal' WHERE ID='$ultimo_id'";
        mysqli_query($conn, $sql);

        $fecha = date ("Ymd");
		$hora = date ("Hi");
		$total = $subtotal + $impuestos;
				
		$factura = array (	'numero' => "$numero",
							'fecha' => "$fecha",
							'hora' => "$hora",
							'subtotal' => "$subtotal",
							'total' => "$total",
							'items' => $items);

		$parametros = array ( 'empresa' => "$empresa",
					  'tienda' => "$tienda",
					  'llave' => "$llave",
					  'factura' => $factura);

		$response = $client->call('RegistrarVenta', $parametros);

	    
        if($estado==0){
            include "includes/ServiceCancelarFactura.php";
            $eleccioMotivo=rand(1,3);
            $motivo='';
            switch ($eleccioMotivo) {
                case 1:
                    $motivo = 'Encontré el mismo juego más barato en otro lugar';
                    break;
                case 2:
                    $motivo = 'El producto me llegó dañado';
                    break;
                case 3:
                    $motivo = 'Prefiero esperar a las ofertas';
                    break;
            }

			$parametros2 = array ( 'empresa' => "$empresa",
						  'tienda' => "$tienda",
						  'llave' => "$llave",
						  'factura' => $numero,
						  'motivo' => "$motivo");

			$response2 = $client2->call('CancelarVenta', $parametros2);

        }
    }
    mysqli_close($conn);
    echo "<script>location.href='index.php';</script>";
?>