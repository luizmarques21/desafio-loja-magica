DROP TABLE IF EXISTS usi_usuario;
CREATE TABLE usi_usuario (
	usi_id INT NOT NULL AUTO_INCREMENT,
	usi_login VARCHAR(100),
	usi_senha VARCHAR(60),
	usi_tipo_usuario CHAR(1),
	usi_data_remocao DATETIME,
	PRIMARY KEY(usi_id)
);

DROP TABLE IF EXISTS pdo_pedido;
CREATE TABLE pdo_pedido (
	pdo_id INT NOT NULL AUTO_INCREMENT,
	cle_id INT,
	pdo_produto MEDIUMTEXT,
	pdo_quantidade INT,
	pdo_data_pedido DATE,
	pdo_valor DOUBLE,
	pdo_deletado BOOL DEFAULT FALSE,
	PRIMARY KEY(pdo_id)
);

DROP TABLE IF EXISTS cle_cliente;
CREATE TABLE cle_cliente (
	cle_id INT NOT NULL AUTO_INCREMENT,
	cle_nome VARCHAR(255),
	cle_email VARCHAR(60),
	cle_tipo CHAR,
	cle_localizacao VARCHAR(255),
	cle_deletado BOOLEAN DEFAULT FALSE,
	PRIMARY KEY(cle_id)
);

ALTER TABLE pdo_pedido ADD CONSTRAINT fk_pedido_cliente FOREIGN KEY (cle_id) REFERENCES cle_cliente(cle_id);

INSERT INTO usi_usuario (usi_login, usi_senha, usi_tipo_usuario) 
VALUES ('admin', '$2y$10$xsveJ2H2SQoGUypi8DOC2.13GP2qqvd2WTt.7uu5NKhACfqggaSKC', 'A');