<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class CreateCsv extends Command
{

    protected $signature = 'app:createcsv';

    protected $description = 'Command creates csv from query resilt';

    public function handle() {
        $file = 'files/result' . rand(1000, 9999) .'.csv';    $handle = fopen($file, 'w');

        /*
        Получить все отзывы, 
        оставленные пользователями из Самары или Волгограда, 
        отзывы которых были полезны для более чем 10 пользователей, 
        
        или которые оставили более 10 отзывов на товары стоимостью более 3 т.р., 
        при среднем рейтинге всех отзывов пользователя на такие товары более 4.
        */

        $query1 = DB::table('reviews')
            ->select('reviews.id_client')
            ->where('reviews.likes', '>', 10)
            ->groupBy('reviews.id_client')
            ->join('clients','reviews.id_client','=','clients.id')
            ->where(function (Builder $cities) {
                $cities->where('city', 'Volgograd')
                      ->orWhere('city', 'Samara');
            });

        $query = DB::table('reviews')
            ->select('reviews.id_client')
            ->join('products','reviews.id_product','=','products.id')
            ->join('clients','reviews.id_client','=','clients.id')
            ->join('ratings','reviews.id_rating','=','ratings.id')
            ->where('products.price', '>', 3000)
            ->where(function (Builder $cities) {
                $cities->where('city', 'Volgograd')
                      ->orWhere('city', 'Samara');
            })
            ->havingRaw('COUNT(reviews.id_client) > ?', [10])
            ->groupBy('reviews.id_client')
            ->havingRaw('AVG(ratings.rating) > ?', [4])
            ->union($query1);

        $clients = $query->get();
        $ids = [];
        foreach($clients as $key=>$client) {
            $ids[] = $client->id_client;
        }

        $reviews = DB::table('reviews')
            ->select('reviews.review')
            ->whereIn('reviews.id_client', $ids)
            ->get();

        foreach ($reviews as $review) {        
            fputcsv($handle, [
                $review->review,            
            ]);
        
        }  

        fclose($handle);
    }
}
