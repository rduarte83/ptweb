UPDATE artigo SET 
  autor = ?, 
  titulo = ?, 
  conteudo = ?, 
  data_criacao = ?, 
  data_edicao = ? 
WHERE
  id = ?;
UPDATE consultas SET 
  data = ?, 
  prof_saude = ?, 
  utente = ?, 
  notas = ? 
WHERE
  id = ?;
UPDATE episodio_dor SET 
  data = ?, 
  utente = ? 
WHERE
  id = ?;
UPDATE logs SET 
  tab = ?, 
  op = ?, 
  time = ?, 
  utilizador = ?, 
  new = ?, 
  old = ? 
WHERE
  id = ?;
UPDATE mensagem SET 
  data = ?, 
  origem = ?, 
  destino = ?, 
  conteudo = ?, 
  lido = ? 
WHERE
  id = ?;
UPDATE notificacoes SET 
  data = ?, 
  id_notificacao = ?, 
  tabela = ?, 
  mensagem = ?, 
  lido = ? 
WHERE
  id = ?;
UPDATE profissional_Saude SET 
   
WHERE
  id = ?;
UPDATE role SET 
  nome = ? 
WHERE
  id = ?;
UPDATE treino SET 
  data_criacao = ?, 
  data_inicio = ?, 
  data_fim = ?, 
  descricao = ?, 
  prof_saude = ?, 
  utente = ?, 
  concluido = ? 
WHERE
  id = ?;
UPDATE utente SET 
  patologias = ?, 
  medicacao = ?, 
  prof_saude = ? 
WHERE
  id = ?;
UPDATE utilizador SET 
  password = ?, 
  nome = ?, 
  morada = ?, 
  nacionalidade = ?, 
  nif = ?, 
  cc = ?, 
  genero = ?, 
  data_nascimento = ?, 
  contacto = ?, 
  mail = ?, 
  role = ?, 
  data_registo = ?, 
  data_login = ? 
WHERE
  id = ?;
UPDATE video SET 
  autor = ?, 
  url = ?, 
  descricao = ? 
WHERE
  id = ?;
UPDATE zona SET 
  nome = ? 
WHERE
  id = ?;
UPDATE zona_artigo SET 
   
WHERE
  zonaid = ? AND artigoid = ?;
UPDATE zona_episodio_dor SET 
  intensidade = ? 
WHERE
  episodio_dorid = ? AND zonaid = ?;
UPDATE zona_video SET 
   
WHERE
  zonaid = ? AND videoid = ?;

