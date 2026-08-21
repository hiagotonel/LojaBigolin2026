
CREATE TABLE cliente
(
  id_cliente INT          NOT NULL AUTO_INCREMENT,
  nome       VARCHAR(40)  NOT NULL,
  cpf        VARCHAR(11)  NOT NULL,
  telefone   VARCHAR(11)  NOT NULL,
  email      VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_cliente)
);

ALTER TABLE cliente
  ADD CONSTRAINT UQ_cpf UNIQUE (cpf);

ALTER TABLE cliente
  ADD CONSTRAINT UQ_telefone UNIQUE (telefone);

ALTER TABLE cliente
  ADD CONSTRAINT UQ_email UNIQUE (email);

CREATE TABLE estoque
(
  id_estoque INT         NOT NULL AUTO_INCREMENT,
  id_produto INT         NOT NULL,
  quantidade INT         NOT NULL,
  pavilhao   VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_estoque)
);

CREATE TABLE marcas
(
  id_marca INT         NOT NULL AUTO_INCREMENT,
  nome     VARCHAR(50) NOT NULL,
  pais     VARCHAR(50) NULL    ,
  PRIMARY KEY (id_marca)
);

CREATE TABLE pedido
(
  id_pedido  INT         NOT NULL AUTO_INCREMENT,
  id_produto INT         NOT NULL,
  id_cliente INT         NOT NULL,
  data       TIMESTAMP   NOT NULL,
  preco      DECIMAL     NOT NULL,
  quantidade INT         NOT NULL,
  status     VARCHAR(40) NULL     DEFAULT 'Em análise',
  PRIMARY KEY (id_pedido)
);

CREATE TABLE produto
(
  id_produto INT         NOT NULL AUTO_INCREMENT,
  id_marca   INT         NOT NULL,
  id_setor   INT         NOT NULL,
  nome       VARCHAR(40) NOT NULL,
  preco      DECIMAL     NOT NULL,
  descricao  VARCHAR(40) NOT NULL,
  status     VARCHAR(40) NULL     DEFAULT 'Sem estoque',
  PRIMARY KEY (id_produto)
);

CREATE TABLE setor
(
  id_setor  INT         NOT NULL AUTO_INCREMENT,
  nome      VARCHAR(50) NOT NULL,
  descricao VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_setor)
);

ALTER TABLE pedido
  ADD CONSTRAINT FK_produto_TO_pedido
    FOREIGN KEY (id_produto)
    REFERENCES produto (id_produto);

ALTER TABLE pedido
  ADD CONSTRAINT FK_cliente_TO_pedido
    FOREIGN KEY (id_cliente)
    REFERENCES cliente (id_cliente);

ALTER TABLE produto
  ADD CONSTRAINT FK_marcas_TO_produto
    FOREIGN KEY (id_marca)
    REFERENCES marcas (id_marca);

ALTER TABLE produto
  ADD CONSTRAINT FK_setor_TO_produto
    FOREIGN KEY (id_setor)
    REFERENCES setor (id_setor);

ALTER TABLE estoque
  ADD CONSTRAINT FK_produto_TO_estoque
    FOREIGN KEY (id_produto)
    REFERENCES produto (id_produto);
