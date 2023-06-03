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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('type_id');
            $table->json('ticket_details');
            $table->string('priority')->default('medium');
            $table->string('status')->default('open');
            $table->unsignedBigInteger('acknowledged_by')->nullable();
            $table->unsignedBigInteger('acknowledged_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('resolved_by')->nullable();
            $table->dateTime('resolved_at')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('type_id')->references('id')->on('ticket_types');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('acknowledged_by')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('resolved_by')->references('id')->on('users');
            $table->foreign('assigned_to')->references('id')->on('users');
            $table->foreign('assigned_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
