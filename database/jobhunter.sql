CREATE DATABASE IF NOT EXISTS jobhunter_ai;
Use jobhunter_ai;

CREATE TABLE vacantes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    empresa VARCHAR(255),
    ubicacion VARCHAR(255),
    modalidad VARCHAR(255),
    salario VARCHAR(100),
    descripcion LONGTEXT,
    url_vacante TEXT,
    fuentes VARCHAR(50),
    fecha_publicacion DATE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);