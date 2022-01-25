<?php
        include "includes/sesionInicio.php";
?>

<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>
<body>
    <div class="wrapper">        
        <main>
            <?php 
                $facturaID=$_GET['ID'];
                $conn=conectar();
                $result=mysqli_query($conn,"SELECT * FROM FacturaMensajes FM WHERE FM.facturaID='$facturaID';"); 
         
                echo "<div class= 'carrito'>
                      <h2 class='subtitulos'>Factura: $facturaID";
                while($row=mysqli_fetch_assoc($result)){
                    $msg=$row['mensaje'];
                    echo "<div>$msg</div>";
                }
                mysqli_close($conn);
                echo "</div>"
            ?>
        </main>

    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>