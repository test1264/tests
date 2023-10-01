<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cname = ['Иван', 'Петр', 'Алексей', 'Дмитрий', 'Сергей'];
        $cname = Arr::random($cname);
        $clname = ['Иванов', 'Петров', 'Алексеев', 'Дмитриев', 'Сергеев'];
        $clname = Arr::random($clname);
        $ccity = ['Volgograd', 'Samara', 'Moscow'];
        $ccity = Arr::random($ccity);

        DB::insert(
            'INSERT INTO clients 
            (name, city)
            VALUES 
            (:name, :city)', 
            [
                'name' =>  $cname . ' ' . $clname,
                'city' => $ccity
                ] 
        );

        $pname = ['Телевизор', 'Утюг', 'Холодильник', 'Плита', 'Телефон'];
        $pname = Arr::random($pname);
        $pprice = rand(1000, 8000);

        DB::insert(
            'INSERT INTO products 
            (name, price)
            VALUES 
            (:name, :price)',
            [
                'name' => $pname,
                'price' => $pprice
                ] 
        );

        $clients = $this->getClientsId();
        $products = $this->getProductsId();

        foreach($clients as $client) {
            $key = rand(0, count($products)-1);
            $product = $products[$key];

            DB::insert(
                'INSERT INTO ratings 
                (id_client, id_product, rating)
                VALUES 
                (:id_client, :id_product, :rating)',
                [
                    'id_client' => $client->id,
                    'id_product' => $product->id,
                    'rating' => rand(1, 10)
                    ] 
                );
            $id_rating = DB::getPdo()->lastInsertId();

            DB::insert(
                'INSERT INTO reviews 
                (id_client, id_product, id_rating, review, likes)
                VALUES 
                (:id_client, :id_product, :id_rating, :review, :likes)',
                [
                    'id_client' => $client->id,
                    'id_product' => $product->id,
                    'id_rating' => $id_rating,
                    'review' => ($client->name . ', ' . $client->city . ': ' . $product->name . ' - ' . $product->price),
                    'likes' => rand(5, 15),
                    ] 
                );

            $id_review = DB::getPdo()->lastInsertId();

            DB::table('ratings')
                ->where('id', $id_rating)
                ->update([
                    'id_review' => $id_review
                ]);

            // $likes = $this->getReviewLikes($id_review, $client->id, $product->id);

            // DB::table('reviews')
            //     ->where('id', $id_review)
            //     ->update([
            //         'likes' => $likes[0]->likes + 1
            //     ]);
        }
    }

    public function getClientsId()  {
        return DB::table('clients')
            ->select('id', 'name', 'city')
            ->get();
    }

    public function getProductsId()  {
        return DB::table('products')
            ->select('id', 'name', 'price')
            ->get();
    }

    public function getReviewLikes($id_review, $id_client, $id_product) {
        return DB::table('reviews')
            ->select('likes')
            ->where('id', $id_review)
            ->where('id_client', $id_client)
            ->where('id_product', $id_product)
            ->get();
    }
}
