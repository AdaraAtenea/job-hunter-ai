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

CREATE TABLE aplicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vacante_id INT NOT NULL,
    fecha_aplicacion DATE,
    estado VARCHAR(50) DEFAULT 'Pendiente',
    notas TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vacante_id)
    REFERENCES vacantes(id)
);

CREATE TABLE perfil_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_profesional VARCHAR(150),
    experiencia_anios DECIMAL(4,1),
    salario_minimo DECIMAL(10,2),
    salario_ideal DECIMAL(10,2),
    ubicaciones TEXT,
    tecnologias TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);