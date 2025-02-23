-- Criando a tabela Person
CREATE TABLE Person (
    id_person INT PRIMARY KEY AUTO_INCREMENT,
    nif INT NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criando a tabela Income
CREATE TABLE Income (
    id_income INT PRIMARY KEY AUTO_INCREMENT,
    value DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criando a tabela Expense
CREATE TABLE Expense (
    id_expense INT PRIMARY KEY AUTO_INCREMENT,
    value DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criando a tabela Person_Income
CREATE TABLE Person_Income (
    id_person_income INT PRIMARY KEY AUTO_INCREMENT,
    id_person INT NOT NULL,
    id_income INT NOT NULL,
    date_income DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_person) REFERENCES Person(id_person),
    FOREIGN KEY (id_income) REFERENCES Income(id_income)
);

-- Criando a tabela Person_Expense
CREATE TABLE Person_Expense (
    id_person_expense INT PRIMARY KEY AUTO_INCREMENT,
    id_person INT NOT NULL,
    id_expense INT NOT NULL,
    date_expense DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_person) REFERENCES Person(id_person),
    FOREIGN KEY (id_expense) REFERENCES Expense(id_expense)
);
