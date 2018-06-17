SELECT id, autor, titulo, conteudo, data_criacao, data_edicao 
  FROM artigo;
SELECT id, data, prof_saude, utente, notas 
  FROM consultas;
SELECT id, data, utente 
  FROM episodio_dor;
SELECT id, tab, op, time, utilizador, new, old 
  FROM logs;
SELECT id, data, origem, destino, conteudo, lido 
  FROM mensagem;
SELECT id, data, id_notificacao, tabela, mensagem, lido 
  FROM notificacoes;
SELECT id 
  FROM profissional_Saude;
SELECT id, nome 
  FROM role;
SELECT id, data_criacao, data_inicio, data_fim, descricao, prof_saude, utente, concluido 
  FROM treino;
SELECT id, patologias, medicacao, prof_saude 
  FROM utente;
SELECT id, password, nome, morada, nacionalidade, nif, cc, genero, data_nascimento, contacto, mail, role, data_registo, data_login 
  FROM utilizador;
SELECT id, autor, url, descricao 
  FROM video;
SELECT id, nome 
  FROM zona;
SELECT zonaid, artigoid 
  FROM zona_artigo;
SELECT episodio_dorid, zonaid, intensidade 
  FROM zona_episodio_dor;
SELECT zonaid, videoid 
  FROM zona_video;

