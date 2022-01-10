<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>


<body>
    <?php
           include "includes/banner.php";
    ?>

    <?php
            include "includes/anuncios.php";
    ?>
    <div class="wrapper">        
        <main>
            <?php 
                $productoID=$_GET['ID'];
                //echo "<h3>$var</h3>"
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT * FROM Videojuego WHERE ID='$productoID'");                     
                $row=mysqli_fetch_assoc($result);
                $nombre=$row["nombre"];
                $descripcion=$row["descripcion"];
                $precio=$row["precio"];
                $imagen=$row["imagen"];
                $plataformaID=$row["plataformaID"];

            ?>

            <div class="administrativo">
                <div class="cont-seccion" id="productos">
                    <?php 
                        echo "<h2 class='subtitulos'>$nombre</h2>";
                    ?>
                    <div class="contenedores productos">

                        <div class="superior">

                            <p class="text descripcion">Descripcion de producto</p>
                            <div class="partessuperior">
                                <div class="parts">
                                    <div class="contenido">
                                        <p class="text"> Precio:</p>
                                        <?php 
                                            echo "<p class='text valor'>₡$precio</p>";
                                        ?>
                                    </div>
                                    <div class="contenido">
                                        <p class="text"> Tipo producto:</p>
                                        <p class="text valor">key</p>
                                    </div>
                                    <p class="text"> Descripcion:</p>
                                    <?php 
                                        echo "<p class='text descripcion'>$descripcion</p>";
                                    ?>
                                </div>
                                <div>
                                    <?php 
                                        echo "<img class='imgProductoCompleto' src='$imagen' alt='No imagen'>";
                                    ?>
                                </div>

                            </div>
                        </div>
                            <?php
                                echo "<a href='anadirCarrito.php?ID=$productoID' class='btn'>";
                            ?>
                            
                                <p class="text">Comprar</p>
                            </a>
                        </div>
                </div>

                <div>
                    <h2 class="subtitulos">Comentarios</h2>
                    <div class="contenedoresProducto">
                        <?php
                            $preguntasResult=mysqli_query($conn, "SELECT Preguntas.ID, Preguntas.comentario, Preguntas.estrellas, Preguntas.fecha, Usuario.email FROM Preguntas, Usuario WHERE Preguntas.videojuegoID='$productoID' AND Usuario.ID=Preguntas.usuarioID");
                            while($rowP=mysqli_fetch_assoc($preguntasResult)){
                                $pregunta=$rowP['comentario'];
                                $nombre=$rowP['email'];
                                $fecha=$rowP['fecha'];
                                $IDP=$rowP['ID'];
                                $estrellas=$rowP['estrellas'];
                                echo "<div class='pregunta'>
                                    <table>
                                        <div class='comentarioTitulo'>
                                            $nombre
                                        </div>
                                        <div class='comentarioFecha'>
                                            $fecha
                                        </div>
                                        <div class='comentario'>
                                            $pregunta
                                        </div>
                                        <tr class='comentarioTitulo'>
                                            <td>$estrellas estrellas</td>
                                        </table>
                                    </div>";
                                    $respuestasResult=mysqli_query($conn, "SELECT * FROM Respuestas, Usuario WHERE Respuestas.preguntaID='$IDP' AND Usuario.ID=Respuestas.usuarioID");
                                    while($rowR=mysqli_fetch_assoc($respuestasResult)){
                                        $respuesta=$rowR['comentario'];
                                        $nombre2=$rowR['email'];
                                        $fecha2=$rowR['fecha'];
                                        echo "<div class='respuesta'>
                                            <table>
                                                <div class='comentarioTitulo'>
                                                    $nombre2
                                                </div>
                                                <div class='comentarioFecha'>
                                                    $fecha2
                                                </div>
                                                <div class='comentario'>
                                                    $respuesta
                                                </div>
                                                </table>
                                            </div>";
                                    }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <?php
            mysqli_close($conn);
        ?>
    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>