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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
        });

        DB::table('sales')->insert(
            array([
                    'id'=> 98,
                    'date' => '2022-11-11',
                    'customer_id' => 3,
                    'employee_id' => 2,
                ],
                [
                    'id'=> 99,
                    'date' => '2022-11-11',
                    'customer_id' => 4,
                    'employee_id' => 1,
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
        Schema::dropIfExists('sales');
    }
};
