<?php
    if (isset($_POST['username'])) {
        include "includes/Conexion.php";
        $connection=conectar();
        $correo = $_POST['username'];
        $contra = $_POST['password'];

        $result=mysqli_query($connection, "SELECT Cliente.ID FROM Usuario, Cliente WHERE Usuario.email='$correo' AND Usuario.contrasena='$contra' AND Usuario.ID=Cliente.usuarioID");                     
                    /*while($row=mysqli_fetch_assoc($result)){
                        echo $row["email"];
                    */

        if (!$row=mysqli_fetch_assoc($result)) {
            header("Location: Logueo.php?error=true");
        } else {
            $clienteID = $row["ID"];
            session_start();
            $_SESSION['usuario']=$correo;
            $_SESSION['ID']=$clienteID;
            header("Location: index.php");
        }
        mysqli_close($connection);
    }
?>

<!DOCTYPE html>
<html lang="en">
    
<?php
        include "includes/Encabezado.php";
?>


<body>
    <div class="administrativo">
        <form method="post" action="#" name="signin-form">
            <div class="logueo">
                <label>Usuario </label>
                <input class="logueoCampo" type="text" name="username" pattern="[a-zA-Z0-9]+" required />
            </div>
            <div class="logueo">
                <label>Contraseña </label>
                <input class="logueoCampo" type="password" name="password" required />
            </div>
            <div class="logueo">
                <?php if(isset($_GET['error']) && $_GET['error'] == 'true'): ?>
                    <center><h4>¡Sus datos no son correctos!</h4></center>
                <?php endif; ?>
            </div>
            <div class="logueo">
                <button type="submit" class="botonLogin" name="login" value="login">Loguearse</button>
            </div>
            <a href="Registro.php">Registrarse</a>
        </form>
    </div>
    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>