DROP DATABASE IF EXISTS BankingApp;
CREATE DATABASE BankingApp;
USE BankingApp;

CREATE TABLE Users (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    PasswordHash VARBINARY(64) NOT NULL,
    TotalBalance DECIMAL(12, 2) NOT NULL DEFAULT 0.00
);

CREATE TABLE Accounts (
    AccountID INT AUTO_INCREMENT PRIMARY KEY,
    CustomerID INT NOT NULL,
    Balance DECIMAL(12, 2) NOT NULL,
    Nickname VARCHAR(50),
    AccountType ENUM('Checking', 'Savings', 'Loan') NOT NULL,
    FOREIGN KEY (CustomerID) REFERENCES Users(CustomerID)
);
