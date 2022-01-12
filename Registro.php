<?php
        include "includes/sesionInicio.php";
?>
<?php
    if (isset($_POST['username'])) {
        include "includes/Conexion.php";
        $conn=conectar();
        $correo = $_POST['username'];
        $contra = $_POST['password'];
        $direc = $_POST['direccion'];
        $telefono = $_POST['movil'];

        $sql="INSERT INTO Usuario (email, contrasena) VALUES ('$correo', '$contra')";

        try {
            mysqli_query($conn, $sql);
            $ultimo_id = mysqli_insert_id($conn); 
            $sql2="INSERT INTO Cliente (direccion, movil, usuarioID) VALUES ('$direc', '$telefono', '$ultimo_id')";
            mysqli_query($conn, $sql2);
            $ultimo_id2 = mysqli_insert_id($conn);
            $sql3="INSERT INTO Carrito (clienteID) VALUES ('$ultimo_id2')";
            mysqli_query($conn, $sql3);
            mysqli_close($conn);
            echo "<script>location.href='Logueo.php';</script>";
            //header("Location: Logueo.php");
        } catch (Exception $e) {
            echo 'Error al cargar datos: ',  $e->getMessage(), "\n";
        }
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
            <div class="registro">
                <label>Usuario </label>
                <input class="logueoCampo" type="text" name="username" pattern="[a-zA-Z0-9]+" required />
            </div>
            <div class="registro">
                <label>Contraseña </label>
                <input class="logueoCampo" type="password" name="password" required />
            </div>
            <div class="registro">
                <label>Dirección </label>
                <input class="logueoCampo" type="text" name="direccion" required />
            </div>
            <div class="registro">
                <label>Móvil </label>
                <input class="logueoCampo" type="number" name="movil" required />
            </div>
            <div class="registro">
                <?php if(isset($_GET['error']) && $_GET['error'] == 'true'): ?>
                    <center><h4>¡Sus datos no son correctos!</h4></center>
                <?php endif; ?>
            </div>
            <div class="registro">
                <button type="submit" class="botonLogin" name="login" value="login">Registrarse</button>
            </div>
            
        </form>
    </div>
    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>