--DROP TRIGGER t_password ON utilizador;
--DROP TRIGGER t_profSaude ON utilizador;

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
	END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

CREATE TRIGGER t_profSaude AFTER INSERT ON utilizador
FOR EACH ROW EXECUTE PROCEDURE f_profSaude();