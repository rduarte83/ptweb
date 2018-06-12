--DROP VIEW vw_utilizadores;
CREATE OR REPLACE VIEW vw_utilizadores AS 
SELECT uti.id,
    uti.password,
    uti.nome,
    uti.morada,
    uti.nacionalidade,
    uti.nif,
    uti.cc,
    uti.genero,
    uti.data_nascimento,
    uti.contacto,
    uti.mail,
    uti.role,
    uti.data_registo,
    uti.data_login,
    ute.patologias,
    ute.medicacao,
    ute.prof_saude,
    r.nome AS role_nome
   FROM utilizador uti
     LEFT JOIN utente ute ON uti.id = ute.id
     LEFT JOIN profissional_saude prof ON uti.id = prof.id
     LEFT JOIN role r ON uti.role = r.id
  ORDER BY uti.id;


--DROP VIEW vw_artigo;
CREATE OR REPLACE VIEW vw_artigo AS
SELECT a.id AS id_artigo
	, a.autor
	, a.titulo
	, a.conteudo
	, a.data_criacao
	, a.data_edicao
	, z.id AS id_zona
	, z.nome AS nome_zona
FROM artigo a
LEFT JOIN zona_artigo za ON a.id = za.artigoid
LEFT JOIN zona z ON z.id = za.zonaid
;

--DROP VIEW vw_video;
CREATE OR REPLACE VIEW vw_video AS
SELECT v.id AS id_video
	, v.autor
	, v.url
	, v.descricao
	, z.id AS id_zona
	, z.nome AS nome_zona
FROM video v
LEFT JOIN zona_video vz ON v.id = vz.videoid
LEFT JOIN zona z ON z.id = vz.zonaid
;

--DROP VIEW vw_episodio;
CREATE OR REPLACE VIEW vw_episodio AS
SELECT e.id AS id_episodio
	, e.data
	, e.zona
	, e.utente
	, z.id AS id_zona
	, z.nome AS nome_zona
	, ze.intensidade
FROM episodio_dor e
LEFT JOIN zona_episodio_dor ze ON e.id = ze.episodio_dorid
LEFT JOIN zona z ON z.id = ze.zonaid
;