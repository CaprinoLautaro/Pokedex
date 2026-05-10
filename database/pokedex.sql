
CREATE DATABASE pokedex;

USE pokedex;

CREATE TABLE usuarios (

                          id INT AUTO_INCREMENT PRIMARY KEY,

                          username VARCHAR(50) NOT NULL UNIQUE,

                          password VARCHAR(255) NOT NULL,

                          is_admin BOOLEAN DEFAULT FALSE

);


CREATE TABLE tipos (

                       id INT AUTO_INCREMENT PRIMARY KEY,

                       nombre VARCHAR(50) NOT NULL UNIQUE,

                       imagen VARCHAR(255) NOT NULL

);

CREATE TABLE pokemons (

                          id INT AUTO_INCREMENT PRIMARY KEY,

                          numero_pokedex INT NOT NULL UNIQUE,

                          nombre VARCHAR(100) NOT NULL,

                          tipo1_id INT NOT NULL,

                          tipo2_id INT NULL,

                          descripcion TEXT,

                          imagen VARCHAR(255) NOT NULL,

                          FOREIGN KEY (tipo1_id)
                              REFERENCES tipos(id),

                          FOREIGN KEY (tipo2_id)
                              REFERENCES tipos(id)

);

INSERT INTO usuarios
(username, password, is_admin)

VALUES
    ('admin1', '1234', TRUE),
    ('admin2', '1234', TRUE),
    ('admin3', '1234', TRUE);