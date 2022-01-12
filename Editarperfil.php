<?php
        include "includes/sesionInicio.php";
?>
<?php 
  if (isset($_POST['direccion'])) {
        include "includes/Conexion.php";
        if(empty($_POST['direccion']) || empty($_POST['movil']) || empty($_POST['email']) || empty($_POST['contrasena'])){
            echo "<script>location.href='Editarperfil.php';</script>";
            //header("Location: Editarperfil.php");
        }else{
            $userID = $_POST['usuarioID'];
            $clienID = $_POST['IDcliente'];
            $dir = $_POST['direccion']; 
            $mov = $_POST['movil']; 
            $mail = $_POST['email']; 
            $contra = $_POST['contrasena']; 
            $conn=conectar();          
            $sql = "UPDATE Usuario SET email='$mail',contrasena ='$contra'  WHERE ID='$userID'";
            mysqli_query($conn, $sql);
            $sql = "UPDATE Cliente SET direccion='$dir',movil ='$mov'  WHERE ID='$clienID'";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            session_start();
            $_SESSION['usuario']=$mail;
            echo "<script>location.href='usuario.php';</script>";
            //header("Location: usuario.php");
        }
    }
?> 


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
                        ?>
                        <input type="hidden" name="IDcliente" value=" <?php echo $clienteID; ?>" >
                        <input type="hidden" name="usuarioID" value=" <?php echo $usuarioID; ?>" >

                        <div class="row">
                            <div> 
                                <label for="direccion">Direccion: </label>
                                <input type="text" class="input-direccion" id="direccion" name="direccion" value = "<?php echo $direccion; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div> 
                                <label for="movil">Telefono: </label>
                                <input type="text" class="form-control" id="movil" name="movil" value = "<?php echo $movil; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div> 
                                <label for="email">Nombre de usuario: </label>
                                <input type="text" class="form-control" id="email" name="email" value = "<?php echo $email; ?>">
                            </div>
                        </div>
                         <div class="row">
                            <div> 
                                <label for="contrasena">Nueva contraseña: </label>
                                <input type="text" class="form-control" id="contrasena" name="contrasena" value = "<?php echo $contrasena; ?>">
                            </div>
                        </div>
                        <div class="rowbtn">
                            <button type="submit" class="btn-carrito">Editar perfil</button>
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