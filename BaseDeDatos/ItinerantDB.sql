CREATE DATABASE Itinerant_DB;

USE Itinerant_DB;

CREATE TABLE Clase (ID INT PRIMARY KEY AUTO_INCREMENT,
					Nombre VARCHAR(50));

CREATE TABLE Encuentro (ID INT PRIMARY KEY AUTO_INCREMENT,
					Nombre VARCHAR(50),
                    Descripcion VARCHAR(100),
                    Experiencia INT,
                    Oro INT,
                    Activo INT);
                    
CREATE TABLE Jugador (ID INT PRIMARY KEY AUTO_INCREMENT,
					Apodo INT,
					Nombre VARCHAR(50),
                    Apellidos VARCHAR(50),
                    Correo VARCHAR(50),
                    FechaRegistro DATE);

CREATE TABLE DungeonMaster (ID INT PRIMARY KEY AUTO_INCREMENT,
					JugadorID INT,
                    FOREIGN KEY (JugadorID) REFERENCES Jugador (ID));

CREATE TABLE Aventura (ID INT PRIMARY KEY AUTO_INCREMENT,
					Nombre VARCHAR(50),
					DungeonMasterID INT,
                    FOREIGN KEY (DungeonMasterID) REFERENCES DungeonMaster (ID));

CREATE TABLE Region (ID INT PRIMARY KEY AUTO_INCREMENT,
					Nombre VARCHAR(50),
                    DungeonMasterID INT,
                    Posicion GEOMETRY,
                    FOREIGN KEY (DungeonMasterID) REFERENCES DungeonMaster (ID));
                    
CREATE TABLE ZonaInteres (ID INT PRIMARY KEY AUTO_INCREMENT,
					Nombre VARCHAR(50),
                    DungeonMasterID INT,
                    RegionID INT,
                    FOREIGN KEY (DungeonMasterID) REFERENCES DungeonMaster (ID),
                    FOREIGN KEY (RegionID) REFERENCES Region (ID));
                    
CREATE TABLE Mercader (ID INT PRIMARY KEY AUTO_INCREMENT,
					Nombre VARCHAR(50),
                    ZonaInteresID INT,
                    FOREIGN KEY (ZonaInteresID) REFERENCES ZonaInteres (ID));

CREATE TABLE Raza (ID INT PRIMARY KEY AUTO_INCREMENT,
					Nombre VARCHAR(50));

CREATE TABLE Personaje(ID INT PRIMARY KEY AUTO_INCREMENT,
						Nivel INT,
                        Experiencia INT,
                        Nombre VARCHAR(50),
                        RazaID INT,
                        RegionID INT,
                        Oro INT,
                        Activo BIT,
						FOREIGN KEY (RazaID) REFERENCES Raza (ID),
						FOREIGN KEY (RegionID) REFERENCES Region (ID));

CREATE TABLE BienesRaices (ID INT PRIMARY KEY AUTO_INCREMENT,
					PersonajeID INT,
                    Nombre VARCHAR(50),
                    FOREIGN KEY (PersonajeID) REFERENCES Personaje (ID));

CREATE TABLE Propiedades (ID INT PRIMARY KEY AUTO_INCREMENT,
					PersonajeID INT,
                    BienesRaicesID INT,
                    Nombre VARCHAR(50),
                    FOREIGN KEY (PersonajeID) REFERENCES Personaje (ID),
                    FOREIGN KEY (BienesRaicesID) REFERENCES BienesRaices (ID));
                        
CREATE TABLE Stats(ID INT PRIMARY KEY AUTO_INCREMENT,
						PersonajeID INT,
                        Fuerza INT,
                        Destreza INT,
                        Constitucion INT,
                        Sabiduria INT,
                        Inteligencia INT,
                        Carisma INT,
						FOREIGN KEY (PersonajeID) REFERENCES Personaje (ID));
                        
CREATE TABLE Inventario (ID INT PRIMARY KEY AUTO_INCREMENT,
				Nombre VARCHAR(50),
                PersonajeID INT,
                FOREIGN KEY (PersonajeID) REFERENCES Personaje (ID));

CREATE TABLE Item (ID INT PRIMARY KEY AUTO_INCREMENT,
				Nombre VARCHAR(50),
                Nivel INT,
                Magico BIT,
                Descripcion VARCHAR(100),
                DungeonMasterID INT,
                InventarioID INT,
                FOREIGN KEY (InventarioID) REFERENCES Inventario (ID),
                FOREIGN KEY (DungeonMasterID) REFERENCES DungeonMaster (ID));
                
CREATE TABLE ItemXMercader (ID INT PRIMARY KEY AUTO_INCREMENT,
					MercaderID INT,
                    ItemID INT,
                    FOREIGN KEY (MercaderID) REFERENCES Mercader (ID),
                    FOREIGN KEY (ItemID) REFERENCES Item (ID)); 
                        
CREATE TABLE PersonajeXClase (ID INT PRIMARY KEY AUTO_INCREMENT,
					PersonajeID INT,
                    ClaseID INT,
                    FOREIGN KEY (PersonajeID) REFERENCES Personaje (ID),
                    FOREIGN KEY (ClaseID) REFERENCES Clase (ID)); 
                        
CREATE TABLE RegionXAdyacente (ID INT PRIMARY KEY AUTO_INCREMENT,
					RegionID INT,
                    AdyacenteID INT,
                    FOREIGN KEY (RegionID) REFERENCES Region (ID),
                    FOREIGN KEY (AdyacenteID) REFERENCES Region (ID));   
    
CREATE TABLE PersonajeXJugador (ID INT PRIMARY KEY AUTO_INCREMENT,
					PersonajeID INT,
                    JugadorID INT,
                    FOREIGN KEY (PersonajeID) REFERENCES Personaje (ID),
                    FOREIGN KEY (JugadorID) REFERENCES Jugador (ID));    
    
CREATE TABLE PersonajeXAventura (ID INT PRIMARY KEY AUTO_INCREMENT,
					PersonajeID INT,
                    AventuraID INT,
                    FOREIGN KEY (PersonajeID) REFERENCES Personaje (ID),
                    FOREIGN KEY (AventuraID) REFERENCES Aventura (ID));
                    
CREATE TABLE EncuentroXAventura (ID INT PRIMARY KEY AUTO_INCREMENT,
					EncuentroID INT,
                    AventuraID INT,
                    FOREIGN KEY (EncuentroID) REFERENCES Encuentro (ID),
                    FOREIGN KEY (AventuraID) REFERENCES Aventura (ID));