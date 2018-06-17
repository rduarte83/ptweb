CREATE TABLE artigo (
  id           SERIAL NOT NULL, 
  autor        int4 NOT NULL, 
  titulo       varchar(100) NOT NULL, 
  conteudo     text NOT NULL, 
  data_criacao date DEFAULT now() NOT NULL, 
  data_edicao  date, 
  PRIMARY KEY (id));
CREATE TABLE consultas (
  id         SERIAL NOT NULL, 
  data       date NOT NULL, 
  prof_saude int4 NOT NULL, 
  utente     int4 NOT NULL, 
  notas      text, 
  PRIMARY KEY (id));
CREATE TABLE episodio_dor (
  id     SERIAL NOT NULL, 
  data   date NOT NULL, 
  utente int4 NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE logs (
  id         SERIAL NOT NULL, 
  tab        text, 
  op         varchar(10), 
  time       timestamp DEFAULT now(), 
  utilizador varchar(20) DEFAULT current_user, 
  new        text, 
  old        text, 
  PRIMARY KEY (id));
CREATE TABLE mensagem (
  id       SERIAL NOT NULL, 
  data     timestamp NOT NULL, 
  origem   int4 NOT NULL, 
  destino  int4 NOT NULL, 
  conteudo int4 NOT NULL, 
  lido     bool DEFAULT 'false' NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE notificacoes (
  id             SERIAL NOT NULL, 
  id_notificacao int4 NOT NULL, 
  tabela         varchar(50) NOT NULL, 
  mensagem       text NOT NULL, 
  lido           bool DEFAULT 'false' NOT NULL, 
  data           timestamp NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE profissional_Saude (
  id int4 NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE role (
  id   SERIAL NOT NULL, 
  nome varchar(50) NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE treino (
  id           SERIAL NOT NULL, 
  data_criacao date DEFAULT now() NOT NULL, 
  data_inicio  date NOT NULL, 
  data_fim     date NOT NULL, 
  descricao    varchar(255) NOT NULL, 
  prof_saude   int4 NOT NULL, 
  utente       int4 NOT NULL, 
  concluido    bool NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE utente (
  id         int4 NOT NULL, 
  patologias text, 
  medicacao  text, 
  prof_saude int4 NOT NULL, 
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
  data_registo    date DEFAULT now() NOT NULL, 
  data_login      date, 
  PRIMARY KEY (id));
CREATE TABLE video (
  id        SERIAL NOT NULL, 
  autor     int4 NOT NULL, 
  url       varchar(255) NOT NULL, 
  descricao varchar(255), 
  PRIMARY KEY (id));
CREATE TABLE zona (
  id   SERIAL NOT NULL, 
  nome varchar(50) NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE zona_artigo (
  zonaid   int4 NOT NULL, 
  artigoid int4 NOT NULL, 
  PRIMARY KEY (zonaid, 
  artigoid));
CREATE TABLE zona_episodio_dor (
  episodio_dorid int4 NOT NULL, 
  zonaid         int4 NOT NULL, 
  intensidade    int4 NOT NULL, 
  PRIMARY KEY (episodio_dorid, 
  zonaid));
CREATE TABLE zona_video (
  zonaid  int4 NOT NULL, 
  videoid int4 NOT NULL, 
  PRIMARY KEY (zonaid, 
  videoid));
ALTER TABLE utente ADD CONSTRAINT FKutente662518 FOREIGN KEY (id) REFERENCES utilizador (id);
ALTER TABLE utilizador ADD CONSTRAINT FKutilizador782488 FOREIGN KEY (role) REFERENCES role (id);
ALTER TABLE episodio_dor ADD CONSTRAINT FKepisodio_d207728 FOREIGN KEY (utente) REFERENCES utente (id);
ALTER TABLE artigo ADD CONSTRAINT FKartigo748980 FOREIGN KEY (autor) REFERENCES profissional_Saude (id);
ALTER TABLE treino ADD CONSTRAINT FKtreino511940 FOREIGN KEY (prof_saude) REFERENCES profissional_Saude (id);
ALTER TABLE treino ADD CONSTRAINT FKtreino161551 FOREIGN KEY (utente) REFERENCES utente (id);
ALTER TABLE profissional_Saude ADD CONSTRAINT FKprofission464774 FOREIGN KEY (id) REFERENCES utilizador (id);
ALTER TABLE mensagem ADD CONSTRAINT FKmensagem76278 FOREIGN KEY (destino) REFERENCES utilizador (id);
ALTER TABLE mensagem ADD CONSTRAINT FKmensagem908651 FOREIGN KEY (origem) REFERENCES utilizador (id);
ALTER TABLE utente ADD CONSTRAINT FKutente993144 FOREIGN KEY (prof_saude) REFERENCES profissional_Saude (id);
ALTER TABLE consultas ADD CONSTRAINT FKconsultas83068 FOREIGN KEY (prof_saude) REFERENCES profissional_Saude (id);
ALTER TABLE consultas ADD CONSTRAINT FKconsultas238912 FOREIGN KEY (utente) REFERENCES utente (id);
ALTER TABLE video ADD CONSTRAINT FKvideo919923 FOREIGN KEY (autor) REFERENCES profissional_Saude (id);
ALTER TABLE zona_episodio_dor ADD CONSTRAINT FKzona_episo412484 FOREIGN KEY (episodio_dorid) REFERENCES episodio_dor (id);
ALTER TABLE zona_episodio_dor ADD CONSTRAINT FKzona_episo66970 FOREIGN KEY (zonaid) REFERENCES zona (id);
ALTER TABLE zona_video ADD CONSTRAINT FKzona_video280650 FOREIGN KEY (zonaid) REFERENCES zona (id);
ALTER TABLE zona_video ADD CONSTRAINT FKzona_video289093 FOREIGN KEY (videoid) REFERENCES video (id);
ALTER TABLE zona_artigo ADD CONSTRAINT FKzona_artig281096 FOREIGN KEY (zonaid) REFERENCES zona (id);
ALTER TABLE zona_artigo ADD CONSTRAINT FKzona_artig992452 FOREIGN KEY (artigoid) REFERENCES artigo (id);

