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
            $table->string('subscripton_id')->nullable();
            $table->string('subscription_name')->nullable();
            $table->float('amount')->nullable();
            $table->string('create_date')->nullable();
            $table->string('currency')->nullable();
            $table->string('mandate')->nullable();
            $table->string('status')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('count')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('plan_id')->nullable();
            $table->string('inquiry_id')->nullable();
            $table->timestamps();
        });
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
