CREATE DATABASE Emmanuel15;

USE Emmanuel15;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    whatsapp VARCHAR(15) NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role ENUM('user') DEFAULT 'user'
);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(255) NOT NULL,
    flyer VARCHAR(255),
    link VARCHAR(255) NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    content TEXT NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    content TEXT NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
);


ALTER TABLE courses ADD description TEXT;
ALTER TABLE courses ADD COLUMN price DECIMAL(10, 2) NOT NULL DEFAULT 0;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE comments ADD COLUMN post_id INT NOT NULL;
ALTER TABLE comments ADD FOREIGN KEY (post_id) REFERENCES posts(id);

CREATE TABLE community_group (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE in_person_training (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    flyer VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    registration_deadline DATE NOT NULL,
    start_date DATE NOT NULL
);

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    training_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    job VARCHAR(255) NOT NULL,
    education_level VARCHAR(255) NOT NULL,
    experience ENUM('oui', 'non') NOT NULL,
    FOREIGN KEY (training_id) REFERENCES in_person_training(id)
);


-- Ajouter l'administrateur initial
INSERT INTO admin (username, email, password) VALUES ('Emmanuel', 'emmanuelfosso205@gmail.com', '00Azerty');
-- Table des formations en personne
CREATE TABLE in_person_training (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    flyer VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    registration_deadline DATE NOT NULL,
    start_date DATE NOT NULL
);

-- Table des inscriptions
CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    training_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    job VARCHAR(255) NOT NULL,
    education_level VARCHAR(255) NOT NULL,
    experience ENUM('oui', 'non') NOT NULL,
    FOREIGN KEY (training_id) REFERENCES in_person_training(id)
);
