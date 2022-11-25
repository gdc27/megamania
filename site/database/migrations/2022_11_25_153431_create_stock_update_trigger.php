<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO Terminer et tester le trigger
        DB::unprepared('
            CREATE TRIGGER NEW_SALE
            BEFORE INSERT OR UPDATE ON DOCUMENT
            FOR EACH ROW
            EXECUTE PROCEDURE UpdateProductsStock();

            CREATE OR REPLACE FUNCTION VerifyDocumentType()
            RETURNS TRIGGER
            AS $$
            BEGIN
                // Récupérer lid de la commande
                // Récupérer les ids et les qtty des products de la commande
                // Update le stock en soustrayant la qtty
            END;
            $$ LANGUAGE PLPGSQL;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_update_trigger');
    }
};
