<?php

namespace Database\Seeders;
use Database\Seeders\ProductSeeder;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
            'name' => 'apple',
            'email' => 'apple@abalit.com',
            'phone' => '666666666',
            'address' => 'mi casa',
            'password' => '1234',
         ]);

         \App\Models\User::factory(30)->create();

         \App\Models\Category::factory()->create([
            'name'=> 'normal'
        ]);

        \App\Models\Category::factory()->create([
            'name'=> 'delivery'
        ]);

        // Llamar al seeder de productos
        $this->call([
            ProductSeeder::class,
        ]);


         \App\Models\Order::factory()->create([

            'pickup_date' => now()->format('Y-m-d'),
            'pickup_time' =>  now()->format('H:i:s'),
            'payment_method'=> 'tarjeta',
            'user_id' => 1,
        ]);

        \App\Models\Order::factory()->create([

            'pickup_date' => now()->format('Y-m-d'),
            'pickup_time' =>  now()->format('H:i:s'),
            'payment_method'=> 'efectivo',
            'user_id' => 1,
        ]);
    }
}
