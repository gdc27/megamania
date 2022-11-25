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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->float("monthly_cost");
            $table->integer("discount_percentage");
        });

        DB::table('subscriptions')->insert(
            array([
                    'id' => 1,
                    'name' => 'Abonnement gratuit',
                    'monthly_cost' => 0,
                    'discount_percentage' => 0
                ],
                [
                    'id' => 2,
                    'name' => 'Abonnement bronze',
                    'monthly_cost' => 3.5,
                    'discount_percentage' => 5
                ],
                [
                    'id' => 3,
                    'name' => 'Abonnement gold',
                    'monthly_cost' => 10,
                    'discount_percentage' => 15
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
        Schema::dropIfExists('subscriptions');
    }
};
