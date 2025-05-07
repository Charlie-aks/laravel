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
        Schema::create('productstore', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->double('price_root');
            $table->unsignedInteger('qty');
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('created_by')->default(1);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productstore');
    }
};
