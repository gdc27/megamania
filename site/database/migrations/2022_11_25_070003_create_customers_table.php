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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("email", 255)->nullable()->unique();
            $table->string("first_name", 30);
            $table->string("last_name", 40);
            $table->foreignId('subscription_id')->nullable()->constrained()->cascadeOnDelete();
        });

        DB::table('customers')->insert(
            array([
                    'id' => 2,
                    'email' => 'Jack@mail.com',
                    'first_name' => "jack",
                    'last_name' => "lumber",
                    'subscription_id' => 3
                ],
                [
                    'id' => 3,
                    'email' => 'rob@mail.com',
                    'first_name' => 'robin',
                    'last_name' => 'mj',
                    'subscription_id' => 1
                ],
                [
                    'id' => 4,
                    'email' => 'gab@mail.com',
                    'first_name' => 'gab',
                    'last_name' => 'dc',
                    'subscription_id' => 2
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
        Schema::dropIfExists('customers');
    }
};
