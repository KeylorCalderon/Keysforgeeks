<?php

function borrarBD($conn){
    try {
        $sql = "DROP TABLE Respuestas; ";
        $conn->query($sql);

        $sql= "DROP TABLE Preguntas;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Factura;" ;
        $conn->query($sql);

        $sql= "DROP TABLE CarritoXVideojuego;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Carrito;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Cliente;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Administrador;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Usuario;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Descuento;" ;
        $conn->query($sql);

        $sql= "DROP TABLE GeneroXVideojuego;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Genero;" ;
        $conn->query($sql);

        $sql= "DROP TABLE PromocionXVideojuego;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Promocion;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Videojuego;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Plataforma;" ;
        $conn->query($sql);

        echo 'Eliminación de tablas exitosa', "\n";
    } catch (Exception $e) {
        echo 'Error al borrar las tablas: ',  $e->getMessage(), "\n";
    }
}

function crearBD($conn){
    try {
        $sql = "CREATE TABLE Plataforma(ID INT PRIMARY KEY AUTO_INCREMENT, nombre VARCHAR(20));";
        $conn->query($sql);

        $sql= "CREATE TABLE Videojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(50),
        codigo VARCHAR(20),
        plataformaID INT,
        precio FLOAT,
        imagen MEDIUMBLOB,
        descripcion VARCHAR(250),
        FOREIGN KEY (plataformaID) REFERENCES Plataforma (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Promocion(ID INT PRIMARY KEY AUTO_INCREMENT,
        rebaja FLOAT,
        imagen MEDIUMBLOB);" ;
        $conn->query($sql);

        $sql= "CREATE TABLE PromocionXVideojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
        promocionID INT,
        videojuegoID INT,
        FOREIGN KEY (promocionID) REFERENCES Promocion (ID),
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Genero(ID INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(50),
        descripcion VARCHAR(250));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE GeneroXVideojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
        generoID INT,
        videojuegoID INT,
        FOREIGN KEY (generoID) REFERENCES Genero (ID),
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Descuento(ID INT PRIMARY KEY AUTO_INCREMENT,
        videojuegoID INT,
        descuento FLOAT,
        imagen MEDIUMBLOB,
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Usuario(ID INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(50),
        contrasena VARCHAR(20));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Administrador(ID INT PRIMARY KEY AUTO_INCREMENT,
        nivel INT,
        usuarioID INT,
        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Cliente(ID INT PRIMARY KEY AUTO_INCREMENT,
        direccion VARCHAR(50),
        movil INT,
        usuarioID INT,
        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Carrito(ID INT PRIMARY KEY AUTO_INCREMENT,
        clienteID INT,
        FOREIGN KEY (clienteID) REFERENCES Cliente (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE CarritoXVideojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
        carritoID INT,
        videojuegoID INT,
        FOREIGN KEY (carritoID) REFERENCES Carrito (ID),
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Factura(ID INT PRIMARY KEY AUTO_INCREMENT,
        carritoID INT,
        fecha DATE,
        subtotal FLOAT,
        FOREIGN KEY (carritoID) REFERENCES Carrito (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Preguntas(ID INT PRIMARY KEY AUTO_INCREMENT,
        usuarioID INT,
        videojuegoID INT,
        comentario VARCHAR(250),
        fecha DATE,
        estrellas INT,
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID),
        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Respuestas(ID INT PRIMARY KEY AUTO_INCREMENT,
        usuarioID INT,
        preguntaID INT,
        comentario VARCHAR(250),
        fecha DATE,
        FOREIGN KEY (preguntaID) REFERENCES Preguntas (ID),
        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));" ;
        $conn->query($sql);

        echo 'Creación de tablas éxitosa', "\n";
    } catch (Exception $e) {
        echo 'Error al crear las tablas: ',  $e->getMessage(), "\n";
    }
}


function cargarDatos($conn){
    try {
        $sql = "INSERT INTO Plataforma(nombre)
        VALUES  ('Steam'),
                ('Epic'),
                ('Android'),
                ('PlayStation 4'),
                ('PlayStation 5'),
                ('Xbox One'),
                ('Xbox Series'),
                ('Nintendo Switch');";
        $conn->query($sql);

        $sql= "INSERT INTO Videojuego(nombre, codigo, plataformaID, precio, imagen, descripcion)
        VALUES ('A Hat in Time', '0001', 1, 11950.95, LOAD_FILE('/img/Producto_AHiT.png'), 'Un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.'),
                ('A Hat in Time', '0001', 2, 11950.95, LOAD_FILE('img/Producto_AHiT.png'), 'Un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.'),
                ('A Hat in Time', '0001', 4, 11950.95, LOAD_FILE('img/Producto_AHiT.png'), 'Un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.')
               ;" ;
        $conn->query($sql);

        /*
        $sql= "CREATE TABLE Promocion(ID INT PRIMARY KEY AUTO_INCREMENT,
        rebaja FLOAT,
        imagen MEDIUMBLOB);" ;
        $conn->query($sql);

        $sql= "CREATE TABLE PromocionXVideojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
        promocionID INT,
        videojuegoID INT,
        FOREIGN KEY (promocionID) REFERENCES Promocion (ID),
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Genero(ID INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(50),
        descripcion VARCHAR(250));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE GeneroXVideojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
        generoID INT,
        videojuegoID INT,
        FOREIGN KEY (generoID) REFERENCES Genero (ID),
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Descuento(ID INT PRIMARY KEY AUTO_INCREMENT,
        videojuegoID INT,
        descuento FLOAT,
        imagen MEDIUMBLOB,
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Usuario(ID INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(50),
        contrasena VARCHAR(20));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Administrador(ID INT PRIMARY KEY AUTO_INCREMENT,
        nivel INT,
        usuarioID INT,
        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Cliente(ID INT PRIMARY KEY AUTO_INCREMENT,
        direccion VARCHAR(50),
        movil INT,
        usuarioID INT,
        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Carrito(ID INT PRIMARY KEY AUTO_INCREMENT,
        clienteID INT,
        FOREIGN KEY (clienteID) REFERENCES Cliente (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE CarritoXVideojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
        carritoID INT,
        videojuegoID INT,
        FOREIGN KEY (carritoID) REFERENCES Carrito (ID),
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Factura(ID INT PRIMARY KEY AUTO_INCREMENT,
        carritoID INT,
        fecha DATE,
        subtotal FLOAT,
        FOREIGN KEY (carritoID) REFERENCES Carrito (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Preguntas(ID INT PRIMARY KEY AUTO_INCREMENT,
        usuarioID INT,
        videojuegoID INT,
        comentario VARCHAR(250),
        fecha DATE,
        estrellas INT,
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID),
        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Respuestas(ID INT PRIMARY KEY AUTO_INCREMENT,
        usuarioID INT,
        preguntaID INT,
        comentario VARCHAR(250),
        fecha DATE,
        FOREIGN KEY (preguntaID) REFERENCES Preguntas (ID),
        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));" ;
        $conn->query($sql);*/

        echo 'Cargado de datos éxitoso', "\n";
    } catch (Exception $e) {
        echo 'Error al cargar datos: ',  $e->getMessage(), "\n";
    }
}
?>