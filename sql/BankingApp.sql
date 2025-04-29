DROP DATABASE IF EXISTS BankingApp;
CREATE DATABASE BankingApp;
USE BankingApp;

CREATE TABLE User (
    CustomerID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    PasswordHash VARBINARY(64) NOT NULL
);

CREATE TABLE Account (
    AccountID INT PRIMARY KEY AUTO_INCREMENT,
    CustomerID INT NOT NULL,
    Balance DECIMAL(12, 2) NOT NULL,
    Nickname VARCHAR(50),
    AccountType ENUM('Checking', 'Savings', 'Loan') NOT NULL,
    FOREIGN KEY (CustomerID) REFERENCES User(CustomerID)
);
