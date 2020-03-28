<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Category;
use App\Author;
use App\Order;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Order::truncate();
        Author::truncate();
        DB::table('order_product')->truncate();
        DB::table('category_product')->truncate();

        $usersQuantity = 200;
        $categoriesQuantity = 30;
        $productQuantity = 1000;
        $authorQuantity = 100;
        $orderQuantity = 400;

        factory(User::class, $usersQuantity)->create();
        factory(Category::class, $categoriesQuantity)->create();
        factory(Author::class, $authorQuantity)->create();
        factory(Product::class, $productQuantity)->create()->each(
            function ($product) {
                $categories = Category::all()->random((mt_rand(2, 5))) ->pluck('id');
                $product->categories()->attach($categories);
            }
        );
        factory(Order::class, $orderQuantity)->create()->each(
            function ($order) {
                $products = Product::all()->random((mt_rand(1, 5)));
                foreach ($products as $product) {
                    $product_id =$product->id;
                    $quantity = rand(1,10);
                    $total =  $product->discount_price * $quantity;
                    $order->products()->attach([$product_id] ,['quantity' => $quantity, 'total' =>$total]);
                }
            }
        );
    }
}
