<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class User
{
    public static function all() {
        return DB::table('users')
            ->select('users.id','users.name','users.surname','users.subscribe')
            ->get();
    }

    public static function getById($id) {
        return DB::table('users')
            ->select('users.id','users.name','users.surname','users.subscribe')
            ->where(['users.id' => $id])
            ->get();
    }

    public static function update($data, $id) {
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'subscribe' => $data['subscribe'],
                ]);
    }
}
