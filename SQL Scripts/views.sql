DROP VIEW vw_utilizadores;
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


DROP VIEW vw_categoria;
CREATE OR REPLACE VIEW vw_categoria AS
SELECT c.id AS id_categoria
	, e.id AS id_expressao
	, e.nome AS nome_expressao
	, z.id AS id_zona
	, z.nome AS nome_zona
FROM categoria c
LEFT JOIN expressoes e ON c.id_expressao = e.id
LEFT JOIN zona z       ON c.id_zona = z.id;


DROP VIEW vw_artigo;
CREATE OR REPLACE VIEW vw_artigo AS
SELECT a.id AS id_artigo
	, a.autor
	, a.titulo
	, a.conteudo
	, a.data_criacao
	, a.data_edicao
	, c.id AS id_categoria
	, e.id AS id_expressao
	, e.nome AS nome_expressao
	, z.id AS id_zona
	, z.nome AS nome_zona
FROM artigo a
LEFT JOIN artigo_categoria ac ON a.id = ac.artigo_id
LEFT JOIN categoria c         ON ac.categoria_id = c.id
LEFT JOIN expressoes e        ON c.id_expressao = e.id
LEFT JOIN zona z              ON c.id_zona = z.id;