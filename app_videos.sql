CREATE DATABASE IF NOT EXISTS app_videos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE app_videos;

-- Tabela de utilizadores
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- Tabela de biblioteca
CREATE TABLE IF NOT EXISTS biblioteca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200),
    autor VARCHAR(200)
);

-- Tabela de vídeos
CREATE TABLE IF NOT EXISTS videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200),
    url VARCHAR(500)
);

-- Inserir dados de teste
INSERT INTO users (name, email, password) VALUES
('Admin', 'teste@teste.com', MD5('123456'));

INSERT INTO biblioteca (titulo, autor) VALUES
('Livro A', 'Autor 1'),
('Livro B', 'Autor 2');

INSERT INTO videos (titulo, url) VALUES
('Video A', 'https://youtube.com/xxxx'),
('Video B', 'https://youtube.com/yyyy');
