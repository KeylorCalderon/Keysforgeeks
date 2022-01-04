
<div class = "anuncio">

<?php

    include "includes/Conexion.php";
    $conn = conectar();

    $sql = "SELECT * FROM Usuario";
    $resultado = $conn -> query($sql);

    if($resultado -> num_rows > 0){
             while($row = $resultado->fetch_assoc()){
                 echo '<br>';
                 echo $row['contrasena'];
             }
     }

?>

</div>


