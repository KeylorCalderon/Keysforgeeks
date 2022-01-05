<!DOCTYPE html>
<html lang="en">

<?php
        include "includes/Encabezado.php";
?>

<body>
    <div class="wrapper">        
        <main>

        <section  class="contacto">
        <h2 class="subtitulos">Contactenos</h2>

        <div class="cont-seccion">
                    <div class="cont-contacto">
                    <form action="">
                        <p> Nombre usuario:</p>
                        <input class="input-user" type="text"name="input-user" id="input-user">
                        <p> Email: </p>
                        <input class="input-email" type="text"name="input-email" id="input-email">
                        <p> Mensaje: </p>
                        <textarea class="textarea-mensaje" name="" id="" cols="30"
                        rows="10"></textarea>
                        <p>
                           <button type="submit" class="btn-enviar">Enviar</button>
                        </p>
                    </form>
                    </div>   

        </section>   
        </main>
    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>