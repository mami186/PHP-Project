
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
    SELECT 1 FROM users WHERE email = 'admin@gmail.com'
);

CREATE TABLE IF NOT EXISTS `budgets` (
    `bg_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,  -- User (employee) who the budget belongs to
    `department_id` INT NOT NULL,  -- Department the budget belongs to

    `bg_amount` DECIMAL(10, 2) NOT NULL,  -- Budget amount
    `bg_start_date` DATE NOT NULL,  -- Budget start date
    `bg_end_date` DATE NOT NULL,  -- Budget end date

    `bg_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
    `bg_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  

    
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON UPDATE CASCADE,
    FOREIGN KEY (`department_id`) REFERENCES `departments`(`id`) ON UPDATE CASCADE
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




