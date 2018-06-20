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
	, v.id AS id_video
	, v.url
	, v.descricao
FROM artigo a
LEFT JOIN zona_artigo za ON a.id = za.artigoid
LEFT JOIN zona z ON z.id = za.zonaid
LEFT JOIN artigo_video av on a.id = av.artigoid
LEFT JOIN video v on av.videoid = v.id
ORDER BY a.id;

--DROP VIEW vw_treino
CREATE OR REPLACE VIEW vw_treino AS
 SELECT t.id AS id_treino
  , t.data_criacao
  , t.data_inicio
  , t.data_fim
  , t.descricao
  , t.prof_saude
  , t.utente
  , t.concluido
  , v.id AS id_video
	, v.url AS url_video
	, v.descricao AS descricao_video
 FROM treino t
 LEFT JOIN treino_video tv on t.id = tv.treinoid
 ORDER BY t.id;

--DROP VIEW vw_episodio;
CREATE OR REPLACE VIEW vw_episodio AS 
 SELECT e.id AS id_episodio,
    e.data,
    e.zona,
    e.utente,
    z.id AS id_zona,
    z.nome AS nome_zona,
    ze.intensidade
   FROM episodio_dor e
     LEFT JOIN zona_episodio_dor ze ON e.id = ze.episodio_dorid
     LEFT JOIN zona z ON z.id = ze.zonaid
  ORDER BY e.id;