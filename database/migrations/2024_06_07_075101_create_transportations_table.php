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
        Schema::create('transportations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            $table->string('product_type');
            $table->string('transportation_type');
            $table->double('fuel');
            
            // jika kendaraan sewaan
            $table->double('cost')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable(); 

            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportations');
    }
};
