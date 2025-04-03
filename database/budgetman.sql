
CREATE DATABASE IF NOT EXISTS budgetman;
USE budgetman;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role ENUM('admin', 'user') NOT NULL ,
    name VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (role, name, email, password) 
SELECT 'admin', 'admin', 'admin@gmail.com', '$2y$10$avcLekD6uCo62hNwZJVOfuV3EKdQiBInKMt3rhZ3ruoxm8zHCWMQa'
WHERE NOT EXISTS (
    SELECT 1 FROM users WHERE id = 1
);

CREATE TABLE IF NOT EXISTS budgets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    name TEXT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    amount_spent DECIMAL(10, 2) DEFAULT 0.00,
    remaining_amount DECIMAL(10, 2) DEFAULT 0.00,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS adminkeys(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE,
    hashedKEY VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    password VARCHAR(100),
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
); 

CREATE TABLE IF NOT EXISTS logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name TEXT NOT NULL,
    bg_dep text NOT NULL,
    bg_amount DECIMAL(10, 2) NOT NULL,
    description TEXT NOT NULL
);

-- Insert test data
INSERT INTO logs (user_name, bg_dep, bg_amount, description) 
VALUES ('Test User', 'IT', 1000.00, 'Test Description');
VALUES ('Test User2 ', 'ITam', 2000.00, 'Test Description2');

CREATE TABLE IF NOT EXISTS departments (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);




