<?php
            include "includes/Encabezado.php";
    ?>
     <!DOCTYPE HTML>
     <html>
     <head> 
     </head>
     <body>

    <div class="wrapper">
        <div class="administrativo">
            <div class="cont-seccion">   
                <div class="contenedores Transacciones">
                    <div class="selecionador">
                        <form class = "formulario" method="post" action="#" name="buscar-form">
                            <input type="date" class="input-date" name="fechaInicio" required>
                            <input type="date" class="input-date" name="fechaFin" required>
                            <select class="input-transacciones" name="tipoBusqueda" id="">
                                <option value="1">Todas las facturas</option>
                                <option value="2">Solo facturas activas</option>
                                <option value="3">Solo facturas canceladas</option>
                            </select>
                            <button type="submit" class="botonLogin" name="buscar" value="buscar">Buscar</button>
                        </form>
                        
                    </div>
                </div>  
                <div id="chartContainer" style="height: 100%; width: 100%;"></div>
            </div>      
        </div> 
    </div>  

    <?php
        include "includes/PiePagina.php";
    ?>

     <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
     </body>
     </html> 
    
     <?php
    if (isset($_POST['fechaFin'])) {
        
        //include "includes/Conexion.php";
        $connection=conectar();
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];
        $tipoBusqueda=$_POST["tipoBusqueda"];

        //echo  "<div>Tipo busqueda: $tipoBusqueda</div>";

        $dataPoints = array(
        );

        if($fechaFin<$fechaInicio){
            echo "<div>ERROR: la fecha de inicio debe ser anterior a la fecha de fin</div>";
        }else{
            while($fechaInicio<=$fechaFin){
                //echo "<div>$fechaInicio</div></br>";

                $cantFacturas=0;
                $result=null; 

                switch ($tipoBusqueda) {
                    case 1:
                        $result=mysqli_query($connection, "SELECT * FROM Factura WHERE Factura.fecha='$fechaInicio'"); 
                        break;
                    case 2:
                        $result=mysqli_query($connection, "SELECT * FROM Factura WHERE Factura.fecha='$fechaInicio' AND Factura.estado=1"); 
                        break;
                    case 3:
                        $result=mysqli_query($connection, "SELECT * FROM Factura WHERE Factura.fecha='$fechaInicio' AND Factura.estado=0"); 
                        break;
                }
                    
                while($row=mysqli_fetch_assoc($result)){
                    $cantFacturas+=1;
                    //echo "<div>$fechaInicio:=$cantFacturas</div></br>";
                }

                array_push($dataPoints, array("label"=> $fechaInicio, "y"=> $cantFacturas));

                $fechaInicio=date("Y-m-d",strtotime($fechaInicio."+ 1 days"));
            }

            echo "<script>
            window.onload = function () {
             
            var chart = new CanvasJS.Chart('chartContainer', {
                animationEnabled: false, //si cambia su valor a true se verá una animación
                exportEnabled: true, //permite guardar exportar el gráfico como JPEG/PNG
                theme: 'light1', // 'light1', 'light2', 'dark1', 'dark2'
                title:{
                    text: 'Gráfico'
                },
                axisX:{      
                    intervalType: 'day',
                    valueFormatString: 'YYYY-MM-DD'
                },
                axisY:{
                    includeZero: true
                },
                data: [{
                    type: 'column', //para cambiar el tipo: bar, line, area, pie, etc
                    indexLabel: '{y}', //Muestra el valor de 'y' en todos los puntos
                    indexLabelFontColor: '#5A5757',
                    indexLabelPlacement: 'outside',   
                    dataPoints:";
            echo json_encode($dataPoints);
            echo "
                }]
            });
            chart.render();
             
            }
            </script>";
        }

        /*$result=mysqli_query($connection, "SELECT * FROM Factura WHERE Factura.fecha
                                           BETWEEN CAST('$fechaInicio' AS DATE) AND
                                           CAST('$fechaFin' AS DATE);");                     
        while($row=mysqli_fetch_assoc($result)){
                echo $row["ID"];
                echo "-";
        }

        mysqli_close($connection);*/
    }
    //SELECT * FROM Factura WHERE Factura.fecha BETWEEN CAST('2021-09-01' AS DATE) AND CAST('2021-11-30' AS DATE);
    //include "includes/Conexion.php";
    //$conn=conectar();
    //%graphData= array();
         
?>