<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
            'name' => 'apple',
            'email' => 'apple@abalit.com',
            'phone' => '666666666',
            'address' => 'mi casa',
            'password' => '1234',
         ]);

         \App\Models\Category::factory()->create([
            'name'=> 'normal'
        ]);

        \App\Models\Category::factory()->create([
            'name'=> 'delivery'
        ]);

        \App\Models\Product::factory(100)->create();

         \App\Models\Order::factory()->create([

            'pickup_date' => now(),
            'pickup_time' => now(),
            'payment_method'=> ' tarjeta',
            'user_id' => 1,
        ]);
    }
}
