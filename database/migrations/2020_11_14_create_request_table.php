<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->integer('requestorID');
            $table->integer('approverID')->nullable();
            $table->integer('reviewerID')->nullable();
            $table->integer('completedBy')->nullable();
            $table->integer('requestType');
            $table->string('department')->nullable();
            $table->integer('ChangeType')->nullable();
            $table->longText('description')->nullable();
            $table->longText('riskAssessment')->nullable();
            $table->longText('functions')->nullable();
            $table->integer('requestStatus');

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
        Schema::dropIfExists('users');
    }
}
