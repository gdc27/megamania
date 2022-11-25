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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name",100);
            $table->text("description")->nullable();
            $table->float("price");
            $table->integer("stock");
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        });

        DB::table('products')->insert(
            array([
                    'id'=> 1,
                    'name' => 'God of War PS5',
                    'description' => "Do it boy !",
                    'price' => 50,
                    'stock' => 27,
                    'category_id' => 2
                ],
                [
                    'id'=> 2,
                    'name' => 'Cyberpunk 2077 PS4',
                    'description' => "You're breath taking !",
                    'price' => 30,
                    'stock' => 15,
                    'category_id' => 3
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
