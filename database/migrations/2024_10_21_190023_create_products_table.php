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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('category_id');
            $table->integer('city_id');
            $table->integer('menu_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('code')->nullable();
            $table->double('price');
            $table->integer('qty');
            $table->double('discount_price')->nullable();
            $table->text('image')->nullable();
            $table->string('product_type')->nullable();
            $table->boolean('status');
            $table->string('size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
