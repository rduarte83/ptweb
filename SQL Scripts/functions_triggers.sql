--Autenticação - devolve true se password validacao
--SELECT password = crypt('entered password', password) FROM utilizador; 

--Trigger para encriptar a password
CREATE OR REPLACE FUNCTION f_password() RETURNS trigger AS $$
    BEGIN
		NEW.password := crypt(NEW.password, gen_salt('md5'));
		RETURN NEW;
    END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

CREATE TRIGGER t_password
BEFORE INSERT OR UPDATE OF password ON utilizador
FOR EACH ROW EXECUTE PROCEDURE f_password();


--Auto fill TRIGGERS
CREATE OR REPLACE FUNCTION f_profSaude() RETURNS trigger AS $$
	BEGIN
	IF (NEW.role = 2) OR (NEW.role = 3) THEN
		INSERT INTO profissional_saude VALUES (NEW.id);
		RETURN NEW;
	END IF;
	RETURN NEW;
	END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

CREATE TRIGGER t_profSaude AFTER INSERT ON utilizador
FOR EACH ROW EXECUTE PROCEDURE f_profSaude();


CREATE OR REPLACE FUNCTION f_activeUser() RETURNS integer AS $$ 
    DECLARE activeuser int := 0; 
    BEGIN 
    RETURN activeuser; 
    END 
$$ LANGUAGE plpgsql SECURITY DEFINER;


-- Criação de LOGS
CREATE OR REPLACE FUNCTION f_logs() RETURNS trigger AS $$
DECLARE activeuser int:= (SELECT f_activeuser());
BEGIN
	IF TG_OP = 'INSERT' THEN 
		INSERT INTO logs (tab, op, utilizador, new)
		VALUES (TG_RELNAME, TG_OP, activeuser, row_to_json(NEW));
        RETURN NEW;
	ELSIF   TG_OP = 'UPDATE' THEN 
		INSERT INTO logs (tab, op, utilizador, new, old)
		VALUES (TG_RELNAME, TG_OP, activeuser, row_to_json(NEW), row_to_json(OLD));
        RETURN NEW;
    ELSIF   TG_OP = 'DELETE' THEN   
        INSERT INTO logs (tab, op, utilizador, old) 
        VALUES (TG_RELNAME, TG_OP, activeuser, row_to_json(OLD));
        RETURN OLD;
    END IF;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- Alerta de treino concluído
CREATE OR REPLACE FUNCTION f_alerta_treino() RETURNS trigger AS $$
BEGIN
  IF NEW.concluido = true THEN
    INSERT INTO notificacoes (id_notificacao, tabela, mensagem)
	VALUES (NEW.id, TG_RELNAME, TG_RELNAME || ' ' || NEW.id || ' concluído');
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

CREATE TRIGGER alerta_treino BEFORE INSERT OR UPDATE ON treino FOR EACH ROW EXECUTE PROCEDURE f_alerta_treino();


--- Criação de notificacoes
CREATE OR REPLACE FUNCTION f_notifications() RETURNS trigger AS $$
BEGIN
	IF TG_OP = 'INSERT' THEN 
		INSERT INTO notificacoes (id_notificacao, tabela, mensagem)
		VALUES (NEW.id, TG_RELNAME, TG_RELNAME || ' ' || NEW.id || ' adicionado com sucesso');
        RETURN NEW;
	ELSIF   TG_OP = 'UPDATE' THEN 
		INSERT INTO notificacoes (id_notificacao, tabela, mensagem)
		VALUES (NEW.id, TG_RELNAME, TG_RELNAME || ' ' || NEW.id ||' editado com sucesso.');
        RETURN NEW;
    ELSIF   TG_OP = 'DELETE' THEN   
        INSERT INTO notificacoes (id_notificacao, tabela, mensagem)
        VALUES (OLD.id, TG_RELNAME, TG_RELNAME || ' ' || NEW.id ||' removido com sucesso.');
        RETURN OLD;
    END IF;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

CREATE TRIGGER not_artigo BEFORE INSERT OR UPDATE OR DELETE ON artigo FOR EACH ROW EXECUTE PROCEDURE f_notifications();
CREATE TRIGGER not_treino BEFORE INSERT OR UPDATE OR DELETE ON treino FOR EACH ROW EXECUTE PROCEDURE f_notifications();
CREATE TRIGGER not_video  BEFORE INSERT OR UPDATE OR DELETE ON video FOR EACH ROW EXECUTE PROCEDURE f_notifications();


-- Query dinamica dos triggers
-- SELECT select_all_triggers();
CREATE OR REPLACE FUNCTION select_all_triggers() RETURNS SETOF text AS $$
SELECT 'CREATE TRIGGER ' || tab_name || ' BEFORE INSERT OR UPDATE OR DELETE ON ' || t_name || ' FOR EACH ROW EXECUTE PROCEDURE f_logs();' AS t_logs 
	FROM (
		SELECT 'logs_'|| table_name AS tab_name, table_name AS t_name 
		FROM information_schema.tables 
			WHERE table_schema='public' AND table_name NOT ILIKE 'logs' AND table_name NOT ILIKE 'vw_%'
			) tablist;
$$ LANGUAGE sql SECURITY DEFINER;


-- Funcao para eliminar todos os triggers numa DB
-- SELECT strip_all_triggers();
CREATE OR REPLACE FUNCTION strip_all_triggers() RETURNS text AS $$ DECLARE
    triggNameRecord RECORD;
    triggTableRecord RECORD;
BEGIN
    FOR triggNameRecord IN select distinct(trigger_name) from information_schema.triggers where trigger_schema = 'public' LOOP
        FOR triggTableRecord IN SELECT distinct(event_object_table) from information_schema.triggers where trigger_name = triggNameRecord.trigger_name LOOP
            RAISE NOTICE 'Dropping trigger: % on table: %', triggNameRecord.trigger_name, triggTableRecord.event_object_table;
            EXECUTE 'DROP TRIGGER ' || triggNameRecord.trigger_name || ' ON ' || triggTableRecord.event_object_table || ';';
        END LOOP;
    END LOOP;

    RETURN 'done';
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;


CREATE TRIGGER logs_role BEFORE INSERT OR UPDATE OR DELETE ON role FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_artigo_categoria BEFORE INSERT OR UPDATE OR DELETE ON artigo_categoria FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_artigo BEFORE INSERT OR UPDATE OR DELETE ON artigo FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_utilizador BEFORE INSERT OR UPDATE OR DELETE ON utilizador FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_treino BEFORE INSERT OR UPDATE OR DELETE ON treino FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_mensagem BEFORE INSERT OR UPDATE OR DELETE ON mensagem FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_utente BEFORE INSERT OR UPDATE OR DELETE ON utente FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_consultas BEFORE INSERT OR UPDATE OR DELETE ON consultas FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_profissional_saude BEFORE INSERT OR UPDATE OR DELETE ON profissional_saude FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_video BEFORE INSERT OR UPDATE OR DELETE ON video FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_video_categoria BEFORE INSERT OR UPDATE OR DELETE ON video_categoria FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_zona BEFORE INSERT OR UPDATE OR DELETE ON zona FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_expressoes BEFORE INSERT OR UPDATE OR DELETE ON expressoes FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_categoria BEFORE INSERT OR UPDATE OR DELETE ON categoria FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_episodio_dor BEFORE INSERT OR UPDATE OR DELETE ON episodio_dor FOR EACH ROW EXECUTE PROCEDURE f_logs();
CREATE TRIGGER logs_expressoes_episodio_dor BEFORE INSERT OR UPDATE OR DELETE ON expressoes_episodio_dor FOR EACH ROW EXECUTE PROCEDURE f_logs();