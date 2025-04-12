CREATE TABLE pessoa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL
);

CREATE TABLE contato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo BOOLEAN NOT NULL,  -- 0 para telefone, 1 para e-mail
    descricao VARCHAR(255) NOT NULL,
    idPessoa INT NOT NULL,
    FOREIGN KEY (idPessoa) REFERENCES pessoa(id) ON DELETE CASCADE
);
