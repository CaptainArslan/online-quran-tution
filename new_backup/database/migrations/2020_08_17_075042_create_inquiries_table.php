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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->nullable();
            $table->mediumText('inquiry')->nullable();
            $table->string('tutor_id')->nullable();
            $table->boolean('is_paid')->default(0)->nullable();
            $table->enum('status', ['pending', 'not_start', 'on_trial', 'started', 'cancelled'])->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('metting_link')->nullable();
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
        Schema::dropIfExists('inquiries');
    }
};
