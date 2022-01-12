
<!DOCTYPE html>
<html lang="en">

<?php
        include "includes/Encabezado.php";
?>

<body>
    <div class="wrapper">        
        <main>
            <div class="administrativo">
                <h2>Editar perfil de usuario</h2>
                    <form class = "cont-perfil" action="#" method = "post" name= "">
                        <div>

                            <?php echo $_SESSION['ID']; ?>
                        </div>


                    </form>      
            </div>
        </main>
    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>