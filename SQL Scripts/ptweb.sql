CREATE TABLE utente (
  id         int4 NOT NULL, 
  patologias text, 
  medicacao  text, 
  prof_saude int4, 
  PRIMARY KEY (id));
CREATE TABLE logs (
  id         SERIAL NOT NULL, 
  tab        text, 
  op         varchar(10), 
  time       timestamp DEFAULT now(), 
  utilizador varchar(20) DEFAULT current_user, 
  new        json, 
  old        json, 
  PRIMARY KEY (id));
CREATE TABLE role (
  id   SERIAL NOT NULL, 
  nome varchar(20) NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE artigo (
  id           SERIAL NOT NULL, 
  autor        int4 NOT NULL, 
  titulo       varchar(100) NOT NULL, 
  conteudo     text NOT NULL, 
  data_criacao timestamp NOT NULL, 
  data_edicao  timestamp, 
  PRIMARY KEY (id));
CREATE TABLE categoria (
  id SERIAL NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE artigo_categoria (
  artigoid    int4 NOT NULL, 
  categoriaid int4 NOT NULL, 
  PRIMARY KEY (artigoid, 
  categoriaid));
CREATE TABLE episodio_dor (
  id          SERIAL NOT NULL, 
  data        date NOT NULL, 
  zona        int4 NOT NULL, 
  intensidade int4 NOT NULL, 
  tipo        int4 NOT NULL, 
  utente      int4 NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE tipo (
  id   int4 NOT NULL, 
  nome varchar(50) NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE intensidade (
  id        int4 NOT NULL, 
  valor     int4 NOT NULL, 
  descricao varchar(255), 
  PRIMARY KEY (id));
CREATE TABLE zona (
  id        int4 NOT NULL, 
  nome      varchar(50) NOT NULL, 
  descricao varchar(255), 
  PRIMARY KEY (id));
CREATE TABLE mensagem (
  id       int4 NOT NULL, 
  data     int4 NOT NULL, 
  origem   int4 NOT NULL, 
  destino  int4 NOT NULL, 
  conteudo int4 NOT NULL);
CREATE TABLE Profissional_Saude (
  id int4 NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE treino (
  id         SERIAL NOT NULL, 
  data       date NOT NULL, 
  descricao  varchar(255) NOT NULL, 
  prof_saude int4 NOT NULL, 
  utente     int4 NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE utilizador (
  id              SERIAL NOT NULL, 
  password        text NOT NULL, 
  nome            varchar(100) NOT NULL, 
  morada          varchar(200) NOT NULL, 
  nacionalidade   varchar(50) NOT NULL, 
  nif             char(9) NOT NULL UNIQUE, 
  cc              char(11) NOT NULL UNIQUE, 
  genero          char(1) NOT NULL, 
  data_nascimento date NOT NULL, 
  contacto        varchar(13), 
  mail            varchar(50), 
  role            int4 NOT NULL, 
  data_registo    date NOT NULL, 
  data_login      date, 
  PRIMARY KEY (id));
ALTER TABLE utente ADD CONSTRAINT FKutente662518 FOREIGN KEY (id) REFERENCES utilizador (id);
ALTER TABLE utilizador ADD CONSTRAINT FKutilizador782488 FOREIGN KEY (role) REFERENCES role (id);
ALTER TABLE artigo_categoria ADD CONSTRAINT FKartigo_cat204593 FOREIGN KEY (artigoid) REFERENCES artigo (id);
ALTER TABLE artigo_categoria ADD CONSTRAINT FKartigo_cat832702 FOREIGN KEY (categoriaid) REFERENCES categoria (id);
ALTER TABLE episodio_dor ADD CONSTRAINT FKepisodio_d207728 FOREIGN KEY (utente) REFERENCES utente (id);
ALTER TABLE episodio_dor ADD CONSTRAINT FKepisodio_d549683 FOREIGN KEY (tipo) REFERENCES tipo (id);
ALTER TABLE episodio_dor ADD CONSTRAINT FKepisodio_d630886 FOREIGN KEY (intensidade) REFERENCES intensidade (id);
ALTER TABLE episodio_dor ADD CONSTRAINT FKepisodio_d918555 FOREIGN KEY (zona) REFERENCES zona (id);
ALTER TABLE artigo ADD CONSTRAINT FKartigo676544 FOREIGN KEY (autor) REFERENCES Profissional_Saude (id);
ALTER TABLE utente ADD CONSTRAINT FKutente432380 FOREIGN KEY (prof_saude) REFERENCES Profissional_Saude (id);
ALTER TABLE treino ADD CONSTRAINT FKtreino913584 FOREIGN KEY (prof_saude) REFERENCES Profissional_Saude (id);
ALTER TABLE treino ADD CONSTRAINT FKtreino161551 FOREIGN KEY (utente) REFERENCES utente (id);
ALTER TABLE zona ADD CONSTRAINT FKzona596722 FOREIGN KEY (id) REFERENCES categoria (id);
ALTER TABLE intensidade ADD CONSTRAINT FKintensidad322001 FOREIGN KEY (id) REFERENCES categoria (id);
ALTER TABLE tipo ADD CONSTRAINT FKtipo412286 FOREIGN KEY (id) REFERENCES categoria (id);
ALTER TABLE Profissional_Saude ADD CONSTRAINT FKProfission960750 FOREIGN KEY (id) REFERENCES utilizador (id);
ALTER TABLE mensagem ADD CONSTRAINT FKmensagem76278 FOREIGN KEY (destino) REFERENCES utilizador (id);
ALTER TABLE mensagem ADD CONSTRAINT FKmensagem908651 FOREIGN KEY (origem) REFERENCES utilizador (id);
