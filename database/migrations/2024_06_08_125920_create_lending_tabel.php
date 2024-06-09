<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transport_id');
            $table->text('purpose');
            $table->unsignedBigInteger('driver_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('supervisor_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('transport_id')->references('id')->on('transportations')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};
