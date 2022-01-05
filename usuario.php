<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>


<body>
    <div class="wrapper">        
        <h1>
            Pantalla de usuario <?php echo $_SESSION['usuario'];?>
        </h1>
        <a href="Logout.php">Cerrar sesión</a>
    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>