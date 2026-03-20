CREATE TABLE IF NOT EXISTS players (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    equipo VARCHAR(255) NOT NULL,
    posicion VARCHAR(255) NOT NULL,
    edad INTEGER NOT NULL,
    promedio_goles FLOAT NOT NULL,
    activo BOOLEAN NOT NULL
);

INSERT INTO players (nombre, equipo, posicion, edad, promedio_goles, activo)
VALUES
('Messi', 'Inter Miami', 'Delantero', 36, 0.85, true),
('Cristiano Ronaldo', 'Al Nassr', 'Delantero', 39, 0.80, true),
('Modric', 'Real Madrid', 'Mediocampista', 38, 0.20, true);