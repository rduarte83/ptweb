--DROP EXTENSION pgcrypto;
--DROP TRIGGER t_password ON utilizador;

--CREATE EXTENSION pgcrypto;

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

CREATE OR REPLACE FUNCTION f_artigo() RETURNS trigger AS $$
	BEGIN
		UPDATE paciente SET em_tratamento='s' WHERE id_paciente = NEW.paciente;
		RETURN NULL;
	END;
$% LANGUAGE plpgsql SECURITY DEFINER;

CREATE TRIGGER tg_emtratamento AFTER INSERT ON tratamento
FOR EACH ROW EXECUTE PROCEDURE func_emtratamento();