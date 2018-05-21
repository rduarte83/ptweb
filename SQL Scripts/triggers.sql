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