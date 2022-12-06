<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION update_stock() RETURNS TRIGGER AS $$
            DECLARE
                var_product_id INT;
                var_quantity INT;
                var_stock INT;
            BEGIN
                SELECT product_id, quantity INTO var_product_id, var_quantity FROM product_sale WHERE sale_id = NEW.sale_id;
                SELECT stock INTO var_stock FROM products WHERE id = var_product_id;
                UPDATE products SET stock = var_stock - var_quantity WHERE id = var_product_id;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER update_stock_trigger
            AFTER INSERT ON product_sale
            FOR EACH ROW
            EXECUTE PROCEDURE update_stock();
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
