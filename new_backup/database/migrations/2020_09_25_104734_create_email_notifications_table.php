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
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->id();
            $table->Boolean('inquiry_mail_to_admin')->default(true);
            $table->Boolean('cred_mail_to_student')->default(true);
            $table->Boolean('tutor_mail_to_student')->default(true);
            $table->Boolean('on_trial_mail_to_tutor')->default(true);
            $table->Boolean('start_mail_to_tutor')->default(true);
            $table->Boolean('appointment_mail_to_student')->default(true);
            $table->Boolean('appointment_mail_to_tutor')->default(true);
            $table->Boolean('tutor_salary_mail')->default(true);
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
        Schema::dropIfExists('email_notifications');
    }
};
