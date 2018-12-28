<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Triggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
CREATE OR REPLACE FUNCTION agregarHoraCompra() RETURNS trigger AS
$$
	BEGIN
	NEW.fecha_compra = now();
	RETURN NEW;
	END
$$ LANGUAGE plpgsql;
        ');
        DB::statement('
CREATE OR REPLACE FUNCTION agregarHoraQueryLog() RETURNS trigger AS
$$
	BEGIN
	NEW.fecha_consulta = now();
	RETURN NEW;
	END
$$ LANGUAGE plpgsql;
');
        DB::statement("
CREATE OR REPLACE FUNCTION agregarQueryLog() RETURNS trigger AS
$$
	BEGIN
	INSERT INTO \"queryLogs\" (id,query,user_id,fecha_consulta) VALUES (DEFAULT,'USUARIO CREADO',1,now());
RETURN NEW;
	END
$$ LANGUAGE plpgsql;
");
        DB::unprepared('
CREATE TRIGGER crearCompra BEFORE INSERT ON "compras" FOR EACH ROW EXECUTE PROCEDURE agregarHoraCompra();
CREATE TRIGGER crearQueryLog BEFORE INSERT ON "queryLogs" FOR EACH ROW EXECUTE PROCEDURE agregarHoraQueryLog();
CREATE TRIGGER crearLog AFTER INSERT ON "users" FOR EACH ROW EXECUTE PROCEDURE agregarQueryLog();
');
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger');
    }
}
