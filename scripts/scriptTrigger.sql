CREATE OR REPLACE FUNCTION agregarHoraCompra() RETURNS trigger AS
$$
	BEGIN
	NEW.fecha_compra = now();
	RETURN NEW;
	END
$$ LANGUAGE plpgsql;

CREATE TRIGGER crearCompra BEFORE INSERT ON "compras" FOR EACH ROW EXECUTE PROCEDURE agregarHoraCompra();

CREATE OR REPLACE FUNCTION agregarHoraQueryLog() RETURNS trigger AS
$$
	BEGIN
	NEW.fecha_consulta = now();
	RETURN NEW;
	END
$$ LANGUAGE plpgsql;

CREATE TRIGGER crearQueryLog BEFORE INSERT ON "queryLogs" FOR EACH ROW EXECUTE PROCEDURE agregarHoraQueryLog();

CREATE OR REPLACE FUNCTION agregarQueryLog() RETURNS trigger AS
$$
	BEGIN
	INSERT INTO "queryLogs" (query,user_id,fecha_consulta)
	       VALUES ("USUARIO CREADO",1,now());
	RETURN NEW;
	END
$$ LANGUAGE plpgsql;

CREATE TRIGGER crearLog BEFORE INSERT ON "users" FOR EACH ROW EXECUTE PROCEDURE agregarQueryLog();
