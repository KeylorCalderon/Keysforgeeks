CREATE DATABASE keysforgeeks_DB;

USE keysforgeeks_DB;

CREATE TABLE Plataforma(ID INT PRIMARY KEY AUTO_INCREMENT,
						nombre VARCHAR(20));

CREATE TABLE Videojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
						nombre VARCHAR(50),
						codigo VARCHAR(20),
                        plataformaID INT,
                        precio FLOAT,
                        imagen MEDIUMBLOB,
						descripcion VARCHAR(250),
                        FOREIGN KEY (plataformaID) REFERENCES Plataforma (ID));
                        
CREATE TABLE Promocion(ID INT PRIMARY KEY AUTO_INCREMENT,
						rebaja FLOAT);
                        
CREATE TABLE PromocionXVideojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
								promocionID INT,
								videojuegoID INT,
                                FOREIGN KEY (promocionID) REFERENCES Promocion (ID),
                                FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));
                                
CREATE TABLE Genero(ID INT PRIMARY KEY AUTO_INCREMENT,
						nombre VARCHAR(50),
                        descripcion VARCHAR(250));
                        
CREATE TABLE GeneroXVideojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
								generoID INT,
								videojuegoID INT,
                                FOREIGN KEY (generoID) REFERENCES Genero (ID),
                                FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));

CREATE TABLE Descuento(ID INT PRIMARY KEY AUTO_INCREMENT,
						videojuegoID INT,
                        descuento FLOAT,
                        FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));
                        
CREATE TABLE Usuario(ID INT PRIMARY KEY AUTO_INCREMENT,
						email VARCHAR(50),
						contrasena VARCHAR(20));
                        
CREATE TABLE Administrador(ID INT PRIMARY KEY AUTO_INCREMENT,
						nivel INT,
                        usuarioID INT,
                        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));
                        
CREATE TABLE Cliente(ID INT PRIMARY KEY AUTO_INCREMENT,
						direccion VARCHAR(50),
                        movil INT,
                        usuarioID INT,
                        FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));

CREATE TABLE Carrito(ID INT PRIMARY KEY AUTO_INCREMENT,
					clienteID INT,
					FOREIGN KEY (clienteID) REFERENCES Cliente (ID));
                        
CREATE TABLE CarritoXVideojuego(ID INT PRIMARY KEY AUTO_INCREMENT,
								carritoID INT,
								videojuegoID INT,
                                FOREIGN KEY (carritoID) REFERENCES Carrito (ID),
                                FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID));
                                
CREATE TABLE Factura(ID INT PRIMARY KEY AUTO_INCREMENT,
					carritoID INT,
					fecha DATE,
                    subtotal FLOAT,
					FOREIGN KEY (carritoID) REFERENCES Carrito (ID));
   
CREATE TABLE Preguntas(ID INT PRIMARY KEY AUTO_INCREMENT,
					usuarioID INT,
                    videojuegoID INT,
                    comentario VARCHAR(250),
                    fecha DATE,
                    estrellas INT,
                    FOREIGN KEY (videojuegoID) REFERENCES Videojuego (ID),
					FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));
                    
CREATE TABLE Respuestas(ID INT PRIMARY KEY AUTO_INCREMENT,
					usuarioID INT,
                    preguntaID INT,
                    comentario VARCHAR(250),
                    fecha DATE,
                    FOREIGN KEY (preguntaID) REFERENCES Preguntas (ID),
					FOREIGN KEY (usuarioID) REFERENCES Usuario (ID));