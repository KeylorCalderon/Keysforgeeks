<?php
        include "includes/sesionInicio.php";
?>
<?php
    $carritoID = $_GET['ID'];
    echo "<div>HOLA: $ID</div>";

    include "includes/Conexion.php";
    $conn=conectar();

    $sql="INSERT INTO Factura(carritoID, fecha, subtotal, estado) VALUES ('$carritoID', CURDATE(), 0, 1)";

        try {
            mysqli_query($conn, $sql);
            $ultimo_id = mysqli_insert_id($conn);

            $result=mysqli_query($conn, "SELECT CXV.ID, V.ID AS parche, V.nombre, precios.precio, V.descripcion
                                                    FROM CarritoXVideojuego CXV, Videojuego V,(
                                                        SELECT CXV.ID, (V.precio-(V.precio*D.descuento/100)) AS precio
                                                        FROM CarritoXVideojuego CXV, Videojuego V, Descuento D
                                                        WHERE CXV.videojuegoID=V.ID AND V.ID=D.videojuegoID
                                                        
                                                        UNION ALL
                                                    
                                                        SELECT CXV.ID, V.precio
                                                        FROM CarritoXVideojuego CXV, Videojuego V
                                                        WHERE CXV.videojuegoID=V.ID AND V.ID NOT IN
                                                        (
                                                            SELECT D.videojuegoID
                                                            FROM Descuento D
                                                        )
                                                    )  AS precios
                                                    WHERE CXV.ID=precios.ID AND CXV.videojuegoID=V.ID AND CXV.carritoID='$carritoID'
                                                    ORDER BY ID ASC");     
            include "includes/ServiceCrearFactura.php";
            
            $resultF=mysqli_query($conn, "SELECT * FROM Llave ORDER BY ID DESC LIMIT 1");  
            $rowF=mysqli_fetch_assoc($resultF);

            $empresa ='EmpresaPruebaWeb';
            $tienda = 'Keysforgeeks';
            $llave = $rowF['llaveTienda'];
            $numero = $ultimo_id;

            $items = array ();
            $subtotal = 0;
            $impuestos = 1.11;
            
            while($row=mysqli_fetch_assoc($result)){
                $nombre=$row['nombre'];
                $precio=$row['precio'];
                $parche=$row['parche'];

                $descripcion = $row['descripcion'];
                $descripcion = substr ( $descripcion, 0, 100);
                $sql="INSERT INTO FacturaDetalle(facturaID, nombre, precio) VALUES ('$ultimo_id', '$nombre', '$precio')";
                mysqli_query($conn, $sql);
                $codigo = mysqli_insert_id($conn);

                $resultA=mysqli_query($conn, "SELECT * 
                                              FROM Descuento D
                                              WHERE D.videojuegoID='$parche';"); 
                $categoria=1;
                if($rowA=mysqli_fetch_assoc($resultA)){
                    $cantDescuento=$rowA['descuento'];
                    if($cantDescuento<=5.0){
                        $categoria=2;
                    }else if($cantDescuento>5.0 && $cantDescuento<=20.0){
                        $categoria=3;
                    }else if($cantDescuento>20.0){
                        $categoria=4;
                    }
                }

                $cantidad = 1;
                $item = array (	'codigo' => "$codigo",
				    			'descripcion' => "$descripcion",
					    		'cantidad' => "$cantidad",
						    	'unitario' => "$precio",
							    'categoria' => "$categoria");
			    array_push ($items, $item);
                $subtotal += $precio * $cantidad;
            }
            $result=mysqli_query($conn, "SELECT SUM(FD.precio) AS Total FROM FacturaDetalle FD WHERE FD.facturaID='$ultimo_id'");  
            $row=mysqli_fetch_assoc($result);
            $totalF=$row['Total'];

            $sql="UPDATE Factura SET subtotal='$totalF' WHERE ID='$ultimo_id'";
            mysqli_query($conn, $sql);

            $sql="DELETE FROM CarritoXVideojuego WHERE carritoID='$carritoID'";
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

            if (empty($response)) {
                //echo "No se recibió respuesta del servicio</h3>";
                $sqlAux="INSERT INTO FacturaMensajes(facturaID, mensaje)
                         VALUES  ('$ultimo_id', 'No se recibió respuesta del servicio');";
                mysqli_query($conn, $sqlAux);
            } else {
                //echo "<h3>Respuesta recibida</h3>";
                foreach ($response as $msg){
                    $msg=utf8_decode($msg);
                    $sqlAux="INSERT INTO FacturaMensajes(facturaID, mensaje)
                         VALUES  ('$ultimo_id', '$msg');";
                    mysqli_query($conn, $sqlAux);
                }        
            }
            

            mysqli_close($conn);
            echo "<script>location.href='catalogo-productos-servicios.php';</script>";
            //header("Location: carrito.php");
        } catch (Exception $e) {
            echo 'Error al cargar datos: ',  $e->getMessage(), "\n";
        }
?>