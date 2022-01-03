<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";
?>

<body>
    <div class="wrapper">  
        <main>
            <style>
                tr td:first-child {
                  border-radius: 15px 0px 0px 15px;
                }
                tr td:last-child  {
                  border-radius: 0px 15px 15px 0px;
                }
              </style>
            <table id="galeria"></table>
        </main>

    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
    
</body>

</html>
