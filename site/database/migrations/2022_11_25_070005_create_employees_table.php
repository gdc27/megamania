<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("first_name",30);
            $table->string("last_name",40);
            $table->float("salary");
            $table->date("hiring_date");
        });

        DB::table('employees')->insert(
            array([
                    'id'=> 1,
                    'first_name' => 'Gertrude',
                    'last_name' => "Maximin",
                    'salary' => 1330,
                    'hiring_date' => '2018-12-27',
                ],
                [
                    'id'=> 2,
                    'first_name' => 'Georges',
                    'last_name' => "Michael",
                    'salary' => 1500,
                    'hiring_date' => '2020-09-12',
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
        Schema::dropIfExists('employees');
    }
};
