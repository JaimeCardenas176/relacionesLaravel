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
            $table->string('name');
            $table->string('description', 5000);
            $table->double('price');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }

    public function normal()
    {
        return $this->afterCreating(function (Producto $producto) {
            $categoriaNormal= Category::firstOrCreate(['name' => 'normal']);
            $producto->categories()->attach($categoriaNormal);
        });
    }

    public function delivery()
    {
        return $this->afterCreating(function (Producto $producto) {
            $categoriaDelivery = Category::firstOrCreate(['name' => 'delivery']);
            $producto->categories()->attach($categoriaDelivery);
        });
    }
};
