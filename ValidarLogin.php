<?php
                include "includes/Conexion.php";
                $connection=conectar();
                //if (isset($_POST['login'])) {

                    $correo = $_POST['username'];
                    $contra = $_POST['password'];

                    $result=mysqli_query($connection, "SELECT * FROM usuario WHERE email='$correo' AND contrasena='$contra'"); 
                    
                    /*while($row=mysqli_fetch_assoc($result)){
                        echo $row["email"];
                    */

                    if (!$row=mysqli_fetch_assoc($result)) {
                        header("Logueo.php");
                    } else {
                        include "index.php";
                    }
                mysqli_close($connection);
            ?>