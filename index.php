<!DOCTYPE html>
<html lang="en">

<?php
        include "includes/Encabezado.php";
?>


<body>
    <div class="wrapper">        
        <main>
            <nav class="menu-paginas">
                <a href="catalogo-productos-servicios.php">Catalogo de productos</a>
                <a href="plantilla-administrativa.php">Sección administrativa</a>
                <a href="pagina_Compra.php">Compra y facturación</a>
            </nav> 
            <?php
                include "includes/Conexion.php";
                include "includes/DatosPrueba.php";
                $conn=conectar();

                //$imagen=$_FILES['/img/Producto_AHiT.png']['tmp_name'];
                //echo $imagen;

                //borrarBD($conn);
                //crearBD($conn);
                //cargarDatos($conn);
                cerrar($conn);
            ?>
        </main>

    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>