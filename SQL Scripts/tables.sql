CREATE TABLE artigo (
  id           SERIAL NOT NULL, 
  autor        int4 NOT NULL, 
  titulo       varchar(100) NOT NULL, 
  conteudo     text NOT NULL, 
  data_criacao timestamp NOT NULL, 
  data_edicao  timestamp, 
  PRIMARY KEY (id));
CREATE TABLE artigo_categoria (
  artigo_id    int4 NOT NULL, 
  categoria_id int4 NOT NULL, 
  PRIMARY KEY (artigo_id, 
  categoria_id));
CREATE TABLE categoria (
  id           SERIAL NOT NULL, 
  id_expressao int4 NOT NULL, 
  id_zona      int4 NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE consultas (
  id         SERIAL NOT NULL, 
  data       date NOT NULL, 
  prof_saude int4 NOT NULL, 
  utente     int4 NOT NULL, 
  notas      text, 
  PRIMARY KEY (id));
CREATE TABLE episodio_dor (
  id        SERIAL NOT NULL, 
  data      date NOT NULL, 
  zona      int4 NOT NULL, 
  utente    int4 NOT NULL, 
  concluido bool NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE zona_episodio_dor (
  episodio_dorid int4 NOT NULL, 
  zonaid         int4 NOT NULL, 
  intensidade    int4 NOT NULL, 
  PRIMARY KEY (episodio_dorid, 
  zonaid));
CREATE TABLE expressoes (
  id   SERIAL NOT NULL, 
  nome varchar(50) NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE expressoes_episodio_dor (
  expressoes_id   int4 NOT NULL, 
  episodio_dor_id int4 NOT NULL, 
  estado          bool NOT NULL, 
  PRIMARY KEY (expressoes_id, 
  episodio_dor_id));
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
  id       int4 NOT NULL, 
  data     int4 NOT NULL, 
  origem   int4 NOT NULL, 
  destino  int4 NOT NULL, 
  conteudo int4 NOT NULL);
CREATE TABLE Profissional_Saude (
  id int4 NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE role (
  id   SERIAL NOT NULL, 
  nome varchar(50) NOT NULL, 
  PRIMARY KEY (id));
CREATE TABLE treino (
  id           SERIAL NOT NULL, 
  data_criacao date NOT NULL, 
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
  data_registo    date NOT NULL, 
  data_login      date, 
  PRIMARY KEY (id));
CREATE TABLE video (
  id        SERIAL NOT NULL, 
  autor     int4 NOT NULL, 
  url       varchar(255) NOT NULL, 
  descricao varchar(255), 
  PRIMARY KEY (id));
CREATE TABLE Video_categoria (
  Videoid     int4 NOT NULL, 
  categoriaid int4 NOT NULL, 
  PRIMARY KEY (Videoid, 
  categoriaid));
CREATE TABLE zona (
  id   SERIAL NOT NULL, 
  nome varchar(50) NOT NULL, 
  PRIMARY KEY (id));
ALTER TABLE utente ADD CONSTRAINT FKutente662518 FOREIGN KEY (id) REFERENCES utilizador (id);
ALTER TABLE utilizador ADD CONSTRAINT FKutilizador782488 FOREIGN KEY (role) REFERENCES role (id);
ALTER TABLE artigo_categoria ADD CONSTRAINT FKartigo_cat840657 FOREIGN KEY (artigo_id) REFERENCES artigo (id);
ALTER TABLE artigo_categoria ADD CONSTRAINT FKartigo_cat638093 FOREIGN KEY (categoria_id) REFERENCES categoria (id);
ALTER TABLE episodio_dor ADD CONSTRAINT FKepisodio_d207728 FOREIGN KEY (utente) REFERENCES utente (id);
ALTER TABLE artigo ADD CONSTRAINT FKartigo676544 FOREIGN KEY (autor) REFERENCES Profissional_Saude (id);
ALTER TABLE treino ADD CONSTRAINT FKtreino913584 FOREIGN KEY (prof_saude) REFERENCES Profissional_Saude (id);
ALTER TABLE treino ADD CONSTRAINT FKtreino161551 FOREIGN KEY (utente) REFERENCES utente (id);
ALTER TABLE Profissional_Saude ADD CONSTRAINT FKProfission960750 FOREIGN KEY (id) REFERENCES utilizador (id);
ALTER TABLE mensagem ADD CONSTRAINT FKmensagem76278 FOREIGN KEY (destino) REFERENCES utilizador (id);
ALTER TABLE mensagem ADD CONSTRAINT FKmensagem908651 FOREIGN KEY (origem) REFERENCES utilizador (id);
ALTER TABLE utente ADD CONSTRAINT FKutente432380 FOREIGN KEY (prof_saude) REFERENCES Profissional_Saude (id);
ALTER TABLE consultas ADD CONSTRAINT FKconsultas342457 FOREIGN KEY (prof_saude) REFERENCES Profissional_Saude (id);
ALTER TABLE consultas ADD CONSTRAINT FKconsultas238912 FOREIGN KEY (utente) REFERENCES utente (id);
ALTER TABLE video ADD CONSTRAINT FKvideo626141 FOREIGN KEY (autor) REFERENCES Profissional_Saude (id);
ALTER TABLE Video_categoria ADD CONSTRAINT FKVideo_cate780349 FOREIGN KEY (Videoid) REFERENCES video (id);
ALTER TABLE Video_categoria ADD CONSTRAINT FKVideo_cate290999 FOREIGN KEY (categoriaid) REFERENCES categoria (id);
ALTER TABLE expressoes_episodio_dor ADD CONSTRAINT FKexpressoes77142 FOREIGN KEY (expressoes_id) REFERENCES expressoes (id);
ALTER TABLE categoria ADD CONSTRAINT FKcategoria376302 FOREIGN KEY (id_zona) REFERENCES zona (id);
ALTER TABLE categoria ADD CONSTRAINT FKcategoria32065 FOREIGN KEY (id_expressao) REFERENCES expressoes (id);
ALTER TABLE expressoes_episodio_dor ADD CONSTRAINT FKexpressoes905691 FOREIGN KEY (episodio_dor_id) REFERENCES episodio_dor (id);
ALTER TABLE episodio_dor_zona ADD CONSTRAINT FKepisodio_d43829 FOREIGN KEY (episodio_dorid) REFERENCES episodio_dor (id);
ALTER TABLE episodio_dor_zona ADD CONSTRAINT FKepisodio_d582247 FOREIGN KEY (zonaid) REFERENCES zona (id);

