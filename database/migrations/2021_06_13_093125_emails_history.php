<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmailsHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails_history', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id');
            $table->string('to_email');
            $table->string('to_name');
            $table->string('from_email');
            $table->string('from_name');
            $table->string('subject');
            $table->longText('body');
            $table->enum('status',array('queued','bounced','delivered'))->default('queued');
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
        //
    }
}
