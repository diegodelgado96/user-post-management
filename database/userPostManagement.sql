CREATE DATABASE blog;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (name, email, password) VALUES
('Juan Pérez', 'juan.perez@example.com', '$2a$12$dS9FoEIODU8g9FgMQlLemu4CEAmd8qEIupEKcl.str/uVFrChET6i'), -- contraseña: 123456789Aa@
('Ana Gómez', 'ana.gomez@example.com', '$2a$12$dS9FoEIODU8g9FgMQlLemu4CEAmd8qEIupEKcl.str/uVFrChET6i'), -- contraseña: 123456789Aa@
('Carlos Ruiz', 'carlos.ruiz@example.com', '$2a$12$dS9FoEIODU8g9FgMQlLemu4CEAmd8qEIupEKcl.str/uVFrChET6i'); -- contraseña: 123456789Aa@


-- Tabla para las categorías (esto es para poder listar posts por categoría)
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

INSERT INTO categories (name) VALUES
('Tecnología'),
('Cultura'),
('Deportes');

-- Tabla para los posts
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO posts (title, content, user_id, category_id) VALUES
('Primer post de Juan', 'Este es el contenido del primer post de Juan Pérez. Hablamos sobre PHP y MySQL.', 1, 1),
('Segundo post de Ana', 'Aquí Ana Gómez comparte su perspectiva sobre las últimas tendencias en cultura.', 2, 2),
('Post sobre deportes', 'Carlos Ruiz comparte su análisis sobre el último partido de fútbol entre equipos locales.', 3, 3);