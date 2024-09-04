<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
        ]);

        // a couple of products here
        $products = Product::factory(5)->create();

        // a bunch of orders belonging to this user
        Order::factory(3)->create([
            'user_id' => $user->id,
        ])->each(function ($order) use ($products) {
            $order->products()->attach(
                $products->random(rand(1, 2))->pluck('id')->toArray(),
                [
                    'quantity' => rand(1, 5),
                    'price' => rand(10, 100),
                ]
            );
        });
    }
}
