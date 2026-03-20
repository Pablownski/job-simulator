CREATE TABLE  IF NOT EXISTS jugadores (
    id  PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    equipo VARCHAR(250) NOT NULL,
    posicion VARCHAR(100) NOT NULL,
    edad INT NOT NULL,
    promedio_goles FLOAT NOT NULL,
    activo BOOLEAN NOT NULL,
);