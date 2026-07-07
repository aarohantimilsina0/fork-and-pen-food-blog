-- ============================================================
-- NIT1101 Assessment 2 - Food Review Blog
-- Database Setup Script
-- ============================================================

CREATE DATABASE IF NOT EXISTS foodblog_db;
USE foodblog_db;

-- ============================================================
-- Table: Categories
-- ============================================================
DROP TABLE IF EXISTS Products;
DROP TABLE IF EXISTS Categories;

CREATE TABLE Categories (
    categoryID   INT AUTO_INCREMENT PRIMARY KEY,
    categoryName VARCHAR(100) NOT NULL
);

-- ============================================================
-- Table: Products  (Food Items / Menu Items)
-- ============================================================
CREATE TABLE Products (
    productID   INT AUTO_INCREMENT PRIMARY KEY,
    categoryID  INT NOT NULL,
    productCode VARCHAR(20) NOT NULL,
    productName VARCHAR(150) NOT NULL,
    listPrice   DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (categoryID) REFERENCES Categories(categoryID)
);

-- ============================================================
-- Seed Data – Categories
-- ============================================================
INSERT INTO Categories (categoryName) VALUES
    ('Breakfast'),
    ('Mains'),
    ('Desserts');

-- ============================================================
-- Seed Data – Products (Food Menu Items)
-- ============================================================
INSERT INTO Products (categoryID, productCode, productName, listPrice) VALUES
-- Breakfast
(1, 'BRK001', 'Avocado Toast',           14.50),
(1, 'BRK002', 'Eggs Benedict',           18.00),
(1, 'BRK003', 'Acai Bowl',               16.00),
(1, 'BRK004', 'Smashed Avo & Feta',      15.50),
-- Mains
(2, 'MNS001', 'Wagyu Beef Burger',       24.00),
(2, 'MNS002', 'Poke Bowl',               22.00),
(2, 'MNS003', 'Truffle Pasta',           28.00),
(2, 'MNS004', 'Grilled Salmon',          32.00),
-- Desserts
(3, 'DST001', 'Matcha Tiramisu',         12.00),
(3, 'DST002', 'Churros & Chocolate',     11.00),
(3, 'DST003', 'Mango Sticky Rice',       10.50),
(3, 'DST004', 'Croffle',                 13.00);
