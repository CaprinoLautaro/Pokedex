CREATE TABLE usuarios (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          username VARCHAR(50) NOT NULL UNIQUE,
                          password VARCHAR(255) NOT NULL,
                          is_admin BOOLEAN DEFAULT FALSE
);

CREATE TABLE pokemons (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          numero_pokedex INT NOT NULL UNIQUE,
                          nombre VARCHAR(100) NOT NULL,
                          tipo ENUM('fuego', 'agua', 'planta', 'electrico') NOT NULL,
                          descripcion TEXT,
                          imagen VARCHAR(255) NOT NULL

);