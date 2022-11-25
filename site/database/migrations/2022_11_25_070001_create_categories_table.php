<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 30);
        });

        DB::table('categories')->insert(
            array([
                'id' => 2,
                'name' => 'Jeux playstation 5'
                ],
                [
                    'id' => 3,
                    'name' => 'Jeux playstation 4'
                ],
                [
                    'id' => 4,
                    'name' => 'Jeux playstation 3'
                ],
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
        Schema::dropIfExists('categories');
    }
};
