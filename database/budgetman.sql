
CREATE DATABASE IF NOT EXISTS budgetman;
USE budgetman;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    dep TEXT NOT NULL,  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS budgets (
    bg_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    dep_name TEXT NOT NULL,

    bg_amount DECIMAL(10, 2) NOT NULL,
    bg_start_date DATE NOT NULL,
    bg_end_date DATE NOT NULL,

    bg_category VARCHAR(100),
    bg_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    bg_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- FOREIGN KEY (user_name) REFERENCES users(name)ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name TEXT NOT NULL,

    bg_dep text NOT NULL,
    bg_amount DECIMAL(10, 2) NOT NULL,
    bg_catagory TEXT NOT NULL,


    -- Foreign Key (user_name) REFERENCES users(name)ON UPDATE CASCADE,
    -- foreign key (bg_dep) references budgets(dep_name)ON UPDATE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);




    amount_spent DECIMAL(10, 2) DEFAULT 0.00,
    remaining_amount DECIMAL(10, 2) DEFAULT 0.00,