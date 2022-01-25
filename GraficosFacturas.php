<?php

    //include "includes/Conexion.php";
    //$conn=conectar();
    //%graphData= array();

     $dataPoints = array(
         array("x"=> 10, "y"=> 41),
         array("x"=> 20, "y"=> 35),
         array("x"=> 30, "y"=> 50),
         array("x"=> 40, "y"=> 45),
         array("x"=> 50, "y"=> 52),
         array("x"=> 60, "y"=> 68),
         array("x"=> 70, "y"=> 38),
         array("x"=> 80, "y"=> 71),
         array("x"=> 90, "y"=> 52),
         array("x"=> 100, "y"=> 60),
         array("x"=> 110, "y"=> 36),
         array("x"=> 120, "y"=> 49),
         array("x"=> 130, "y"=> 41)
     );
         
     ?>
     
    <?php
            include "includes/Encabezado.php";
    ?>
     <!DOCTYPE HTML>
     <html>
     <head> 
     <script>
     window.onload = function () {
      
     var chart = new CanvasJS.Chart("chartContainer", {
         animationEnabled: false, //si cambia su valor a true se verá una animación
         exportEnabled: true, //permite guardar exportar el gráfico como JPEG/PNG
         theme: "light1", // "light1", "light2", "dark1", "dark2"
         title:{
             text: "Gráfico"
         },
         axisY:{
             includeZero: true
         },
         data: [{
             type: "column", //para cambiar el tipo: bar, line, area, pie, etc
             indexLabel: "{y}", //Muestra el valor de "y" en todos los puntos
             indexLabelFontColor: "#5A5757",
             indexLabelPlacement: "outside",   
             dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
         }]
     });
     chart.render();
      
     }
     </script>
     </head>
     <body>

    <div class="wrapper">
        <div class="administrativo">
            <div class="cont-seccion">   
                <div class="contenedores Transacciones">
                    <div class="selecionador">
                        <form class = "formulario" action="">
                            <input type="date" class="input-date">
                        </form>
                        <form class = "formulario" action="">
                            <input type="date" class="input-date">
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
