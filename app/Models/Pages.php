<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Pages
{
    public static function getBySlug($slug) {
        return DB::table('pages')
            ->select('pages.title', 'pages.description', 'pages.keywords', 'pages.body')
            ->where(['pages.slug' => $slug])
            ->get();
    }

    public static function store($data) {
        DB::insert(
            'INSERT INTO pages 
            (slug, title, description, keywords, body)
            VALUES 
            (:slug, :title, :description, :keywords, :body)',
            [
                'slug' => $data['slug'],
                'title' => $data['title'],
                'description' => $data['description'],
                'keywords' => $data['keywords'],
                'body' => $data['body']
                ] 
        );
    }
}
