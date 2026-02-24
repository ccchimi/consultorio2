CREATE DATABASE IF NOT EXISTS consultorio;
USE consultorio;

-- Crear tabla de usuarios (users) primero
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Crear tabla de pacientes después de `users`
CREATE TABLE IF NOT EXISTS pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    dni VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    telefono VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    user_id BIGINT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Crear tabla de turnos después de `pacientes`
CREATE TABLE IF NOT EXISTS turnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dni_paciente VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    status ENUM('Confirmado', 'Cancelado', 'Pendiente') DEFAULT 'Pendiente',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    user_id BIGINT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Resetear el auto_increment para que empiece desde 1
ALTER TABLE pacientes AUTO_INCREMENT = 1;
ALTER TABLE turnos AUTO_INCREMENT = 1;
ALTER TABLE users AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS pacientes, turnos, users; -- NO RUNNEAR, ES PARA RESETEAR TODO
