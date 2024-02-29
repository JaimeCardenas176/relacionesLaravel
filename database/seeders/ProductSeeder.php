<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 150 productos asociados a la categoría normal
        Product::factory(150)->create()->each(function ($producto) {
            $this->normal($producto);
        });

        // Crear 150 productos asociados a la categoría delivery
        Product::factory(150)->create()->each(function ($producto) {
            $this->delivery($producto);
        });
    }

    private function normal($producto)
    {
        // Lógica para asociar el producto a la categoría normal
        $categoriaNormal = Category::firstOrCreate(['name' => 'normal']);
        $producto->categories()->attach($categoriaNormal);
        $categoriaNormal->products()->attach($producto);
    }

    private function delivery($producto)
    {
        // Lógica para asociar el producto a la categoría delivery
        $categoriaDelivery = Category::firstOrCreate(['name' => 'delivery']);
        $producto->categories()->attach($categoriaDelivery);
        $categoriaDelivery->products()->attach($producto);
    }

}
