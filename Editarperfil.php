
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

                            <?php 
                                $clienteID=$_SESSION['ID'];
                                $conn=conectar();
                                $result=mysqli_query($conn, "SELECT U.ID, C.direccion, C.movil, U.email, U.contrasena FROM Usuario U, Cliente C WHERE U.ID=C.usuarioID AND C.ID='$clienteID'");                     
                                $row=mysqli_fetch_assoc($result);
                                $usuarioID=$row['ID'];
                                $direccion=$row['direccion'];
                                $movil=$row['movil'];
                                $email=$row['email'];
                                $contrasena=$row['contrasena'];

                                mysqli_close($conn);

                                echo "<div>ID cliente: '$clienteID'</div>
                                    <div>ID usuario: '$usuarioID'</div>
                                    <div>ID direccion: '$direccion'</div>
                                    <div>ID movil: '$movil'</div>
                                    <div>ID email: '$email'</div>
                                    <div>ID contrasena: '$contrasena'</div>";
                            ?>
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