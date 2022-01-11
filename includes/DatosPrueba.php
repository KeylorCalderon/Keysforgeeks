<?php

function borrarBD($conn){
    try {
        $sql = "DROP TABLE Respuestas; ";
        $conn->query($sql);

        $sql= "DROP TABLE Preguntas;" ;
        $conn->query($sql);

        $sql= "DROP TABLE FacturaDetalle;" ;
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
        imagen VARCHAR(50),
        descripcion VARCHAR(1500),
        activo BIT,
        FOREIGN KEY (plataformaID) REFERENCES Plataforma (ID));" ;
        
        $conn->query($sql);

        $sql= "CREATE TABLE Promocion(ID INT PRIMARY KEY AUTO_INCREMENT,
        rebaja FLOAT,
        imagen VARCHAR(50));" ;
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
        imagen VARCHAR(50),
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

        $sql= "CREATE TABLE FacturaDetalle(ID INT PRIMARY KEY AUTO_INCREMENT,
        facturaID INT,
        nombre VARCHAR(50),
        precio FLOAT,
        FOREIGN KEY (facturaID) REFERENCES Factura (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Preguntas(ID INT PRIMARY KEY AUTO_INCREMENT,
        usuarioID INT,
        videojuegoID INT,
        comentario VARCHAR(1500),
        fecha DATE,
        estrellas INT,
        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID),
        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Respuestas(ID INT PRIMARY KEY AUTO_INCREMENT,
        usuarioID INT,
        preguntaID INT,
        comentario VARCHAR(1500),
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

        $sql= "INSERT INTO Videojuego(nombre, codigo, plataformaID, precio, imagen, descripcion, activo)
        VALUES  ('A Hat in Time', '0001', 1, 11950.95, 'img/Producto_AHiT.png', 'Un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.', 1),
                ('A Hat in Time', '0002', 2, 11950.95, 'img/Producto_AHiT.png', 'Un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.', 1),
                ('A Hat in Time', '0003', 4, 11950.95, 'img/Producto_AHiT.png', 'Un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.', 1),
                
                ('Zelda Breath of the Wild', '2391', 8, 39950.95, 'img/Producto_BOTW.jpg', 'Un videojuego de acción-aventura de 2017 de la serie The Legend of Zelda, presenta un mundo abierto que le permite al jugador encontrar distintas maneras de completar un objetivo.', 1),

                ('Celeste', 'dsjsmsa001', 1, 5950.95, 'img/Producto_Celeste.png', 'Ayuda a Madeline a superar sus demonios internos en su travesía a la cima de la Montaña Celeste, en este intenso juego de plataformas diseñado a mano por los creadores del clásico TowerFall.', 1),
                ('Celeste', 'samk1', 2, 5950.95, 'img/Producto_Celeste.png', 'Ayuda a Madeline a superar sus demonios internos en su travesía a la cima de la Montaña Celeste, en este intenso juego de plataformas diseñado a mano por los creadores del clásico TowerFall.', 1),
                ('Celeste', '0dma001ssa', 7, 5950.95, 'img/Producto_Celeste.png', 'Ayuda a Madeline a superar sus demonios internos en su travesía a la cima de la Montaña Celeste, en este intenso juego de plataformas diseñado a mano por los creadores del clásico TowerFall.', 1),
               
                ('Final Fantasy IX', 'FFowiud91', 1, 9950.95, 'img/Producto_FinalFantasyIX.jpg', '¡En un mundo de fantasía, el ladrón Yitán, la princesa Garnet de Alejandría y el joven mago negro Vivi se verán envueltos en una aventura llena de emoción! El galardonado FF IX ya se encuentra disponible.', 1),
                ('Final Fantasy IX', 'FFowiud91', 4, 9950.95, 'img/Producto_FinalFantasyIX.jpg', '¡En un mundo de fantasía, el ladrón Yitán, la princesa Garnet de Alejandría y el joven mago negro Vivi se verán envueltos en una aventura llena de emoción! El galardonado FF IX ya se encuentra disponible.', 1),
                ('Final Fantasy IX', 'FFowiud91', 8, 10950.95, 'img/Producto_FinalFantasyIX.jpg', '¡En un mundo de fantasía, el ladrón Yitán, la princesa Garnet de Alejandría y el joven mago negro Vivi se verán envueltos en una aventura llena de emoción! El galardonado FF IX ya se encuentra disponible.', 1),

                ('Hollow Knight', '000dams1', 1, 10950.95, 'img/Producto_HollowKnight.png', 'La galardonada aventura de acción. Explora cavernas serpenteantes, antiguas ciudades y páramos mortales. Lucha contra criaturas mancilladas y haz nuevas amistades con extraños insectos. Descubre una antigua historia y resuelve los misterios de este reino.', 1),
                ('Hollow Knight', '0001qwq', 2, 12450.95, 'img/Producto_HollowKnight.png', 'La galardonada aventura de acción. Explora cavernas serpenteantes, antiguas ciudades y páramos mortales. Lucha contra criaturas mancilladas y haz nuevas amistades con extraños insectos. Descubre una antigua historia y resuelve los misterios de este reino.', 1),
                ('Hollow Knight', '0eadd1', 4, 10450.95, 'img/Producto_HollowKnight.png', 'La galardonada aventura de acción. Explora cavernas serpenteantes, antiguas ciudades y páramos mortales. Lucha contra criaturas mancilladas y haz nuevas amistades con extraños insectos. Descubre una antigua historia y resuelve los misterios de este reino.', 1),
                ('Hollow Knight', '0001adcks', 5, 11950.95, 'img/Producto_HollowKnight.png', 'La galardonada aventura de acción. Explora cavernas serpenteantes, antiguas ciudades y páramos mortales. Lucha contra criaturas mancilladas y haz nuevas amistades con extraños insectos. Descubre una antigua historia y resuelve los misterios de este reino.', 1),
                ('Hollow Knight', '000KLASM1', 6, 10450.95, 'img/Producto_HollowKnight.png', 'La galardonada aventura de acción. Explora cavernas serpenteantes, antiguas ciudades y páramos mortales. Lucha contra criaturas mancilladas y haz nuevas amistades con extraños insectos. Descubre una antigua historia y resuelve los misterios de este reino.', 1),
                ('Hollow Knight', '000KROOL1', 7, 10950.95, 'img/Producto_HollowKnight.png', 'La galardonada aventura de acción. Explora cavernas serpenteantes, antiguas ciudades y páramos mortales. Lucha contra criaturas mancilladas y haz nuevas amistades con extraños insectos. Descubre una antigua historia y resuelve los misterios de este reino.', 1),
                ('Hollow Knight', '0001PRUEBA', 8, 13950.95, 'img/Producto_HollowKnight.png', 'La galardonada aventura de acción. Explora cavernas serpenteantes, antiguas ciudades y páramos mortales. Lucha contra criaturas mancilladas y haz nuevas amistades con extraños insectos. Descubre una antigua historia y resuelve los misterios de este reino.', 1),

                ('Kingdom Hearts All in One', 'FFowiud9cmcmcm1', 2, 40950.95, 'img/Producto_KH_All_in_One.png', 'El Paquete KINGDOM HEARTS todo en uno incluye: KINGDOM HEARTS HD 1.5 + 2.5 ReMIX, KINGDOM HEARTS HD 2.8 Final Chapter Prologue, KINGDOM HEARTS III', 1),
                ('Kingdom Hearts All in One', 'FFowsad91', 4, 60950.95, 'img/Producto_KH_All_in_One.png', 'El Paquete KINGDOM HEARTS todo en uno incluye: KINGDOM HEARTS HD 1.5 + 2.5 ReMIX, KINGDOM HEARTS HD 2.8 Final Chapter Prologue, KINGDOM HEARTS III', 1),
                ('Kingdom Hearts All in One', 'FFowiuddd91', 6, 60950.95, 'img/Producto_KH_All_in_One.png', 'El Paquete KINGDOM HEARTS todo en uno incluye: KINGDOM HEARTS HD 1.5 + 2.5 ReMIX, KINGDOM HEARTS HD 2.8 Final Chapter Prologue, KINGDOM HEARTS III', 1),

                ('Uncharted 4', 'mdad2391', 4, 19950.95, 'img/Producto_Uncharted4.jpg', '3 años después de UNCHARTED 3, Nathan Drake se retiró del mundo de los cazafortunas. Pero, el destino no tarda en golpear su puerta cuando su hermano Sam reaparece en busca de ayuda para salvar su propia vida, una aventura demasiado tentadora e irresistible para Drake.', 1),
                ('Uncharted 4', 'remastered2391', 5, 39950.95, 'img/Producto_Uncharted4.jpg', '3 años después de UNCHARTED 3, Nathan Drake se retiró del mundo de los cazafortunas. Pero, el destino no tarda en golpear su puerta cuando su hermano Sam reaparece en busca de ayuda para salvar su propia vida, una aventura demasiado tentadora e irresistible para Drake.', 1)
               ;" ;

        $conn->query($sql);

        $sql = "INSERT INTO Promocion(rebaja, imagen)
        VALUES  (25.0, 'img/Banner1.jpg'), (30.0, 'img/Banner2.jpg') ;";
        $conn->query($sql);

        $sql = "INSERT INTO PromocionXVideojuego(promocionID, videojuegoID)
        VALUES  (1,1),
                (1,11);";
        $conn->query($sql);

        $sql = "INSERT INTO Genero(nombre, descripcion)
        VALUES  ('Plataformas', 'Juegos con secciones plataformeras'),
                ('Aventura', 'Juegos de aventuras'),
                ('Exploración', 'Juegos para explorar'),
                ('Puzzles', 'Juegos de rompecabezas'),
                ('RPG', 'Juegos de rol'),
                ('Metroidvania', 'Genero nacido de la saga Metroid y la saga Castlevania'),
                ('ARPG', 'RPGs de acción'),
                ('Shooter', 'Juegos de disparos');";
        $conn->query($sql);

        $sql = "INSERT INTO GeneroXVideojuego(generoID, videojuegoID)
        VALUES  (1,1),
                (1,2),
                (1,3),
                (2,4),
                (3,4),
                (4,5),
                (4,6),
                (4,7),
                (5,8),
                (5,9),
                (5,10),
                (6,11),
                (6,12),
                (6,13),
                (6,14),
                (6,15),
                (6,16),
                (6,17),
                (7,18),
                (7,19),
                (7,19),
                (8,20),
                (8,21);";

        $conn->query($sql);

        $sql = "INSERT INTO Descuento(videojuegoID, descuento, imagen)
        VALUES  (20, 35.0, 'img/Anuncio1.jpg'),  (10, 40.0, 'img/Anuncio2.jpg');";
        $conn->query($sql);

        $sql = "INSERT INTO Usuario(email, contrasena)
        VALUES  ('Prueba1','123'),
                ('Prueba2','456'),
                ('Prueba3','789'),
                ('Admin','Admin123');";
        $conn->query($sql);

        $sql = "INSERT INTO Administrador(nivel, usuarioID)
        VALUES  (1, 4);";
        $conn->query($sql);

        $sql = "INSERT INTO Cliente(direccion, movil, usuarioID)
        VALUES  ('En mi casa', 29182, 1),
                ('500 metros norte del parque', 318393, 2),
                ('Segundo piso enfrente del TEC', 431983, 3);";
        $conn->query($sql);

        $sql = "INSERT INTO Carrito(clienteID)
        VALUES  (1),
                (2),
                (3);";
        $conn->query($sql);

        $sql = "INSERT INTO CarritoXVideojuego(carritoID, videojuegoID)
        VALUES  (2,2),
                (2,4),
                (3,5),
                (3,10),
                (3,15);";
        $conn->query($sql);

        $sql = "INSERT INTO Factura(carritoID, fecha, subtotal)
        VALUES  (1,'2021-09-21', 78302.50),
                (3,'2021-05-11', 312302.50),
                (3,'2021-03-23', 43302.50),
                (3,'2019-02-03', 12302.50),
                (2,'2021-11-02', 118302.50);";
        $conn->query($sql);

        $sql = "INSERT INTO FacturaDetalle(facturaID, nombre, precio)
        VALUES  (1,'A Hat in Time', 8302.50),
                (1,'Celeste', 2302.50),
                (1,'Hollow Knight', 21302.50),
                (3,'A Hat in Time', 8302.50),
                (3,'Celeste', 2302.50),
                (3,'Hollow Knight', 21302.50),
                (4,'A Hat in Time', 8302.50),
                (4,'Celeste', 2302.50),
                (4,'Hollow Knight', 21302.50),
                (5,'A Hat in Time', 8302.50),
                (5,'Celeste', 2302.50),
                (5,'Hollow Knight', 21302.50),
                (2,'Azul', 302.50),
                (2,'Celeste', 5302.50);";
        $conn->query($sql);

        $sql = "INSERT INTO Preguntas(usuarioID, videojuegoID, comentario, fecha, estrellas)
        VALUES  (1,1,'Una gran obra de arte, es increíble como lograron que una fórmula que parecía gastada resurgiera, llena de momento divertidos y un tono que cautiva a cualquiera.', '2021-05-03',5),
                (2,1,'muy mal videojuejo es inposible pazar del primer mundo. no compren,', '2021-08-06',1);";
        $conn->query($sql);

        $sql = "INSERT INTO Respuestas(usuarioID, preguntaID, comentario, fecha)
        VALUES  (3, 1, 'Completamente de acuerdo con usted, fue desde luego, una de las experiencias más gratas que he tenido en mis 20 años como videojugador.', '2022-01-01');";
        $conn->query($sql);

        echo 'Cargado de datos éxitoso', "\n";
    } catch (Exception $e) {
        echo 'Error al cargar datos: ',  $e->getMessage(), "\n";
    }
}
?>