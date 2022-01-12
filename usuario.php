<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>


<body>
    <div class="wrapper">   
        <?php
            if($_SESSION['Admin']=='1'){
                echo "<h1>
                        Pantalla de Administrador
                    </h1>
                    <a href='GestionarProductos.php'>Gestionar productos</a>
                    <a href='GestionarDescuentos.php'>Gestionar descuentos</a>
                    <a href='Logout.php'>Cerrar sesión</a>";
            }
            else{
                $nombreUsuario= $_SESSION['usuario'];
                echo "<h1>
                        Pantalla de usuario '$nombreUsuario'
                    </h1>
                    <a href='Editarperfil.php'>Editar Perfil</a>
                    <a href='ComprasAnteriores.php'>Compras anteriores</a>
                    <a href='Logout.php'>Cerrar sesión</a>";
            }
        ?>
    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>