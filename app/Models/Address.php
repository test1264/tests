<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Address
{
    public static function getById($id) {
        return DB::table('addresses')
            ->select('addresses.user_id', 'addresses.region','addresses.city','addresses.street','addresses.house','addresses.zipcode')
            ->where(['addresses.id' => $id])
            ->get();
    }

    public static function getByUserId($id) {
        return DB::table('addresses')
            ->select('addresses.id', 'addresses.region','addresses.city','addresses.street','addresses.house','addresses.zipcode')
            ->where(['addresses.user_id' => $id])
            ->get();
    }

    public static function store($data) {
        DB::insert(
            'INSERT INTO addresses 
            (user_id, region, city, street, house, zipcode)
            VALUES 
            (:user_id, :region, :city, :street, :house, :zipcode)',
            [
                'user_id' => $data['user_id'],
                'region' => $data['region'],
                'city' => $data['city'],
                'street' => $data['street'],
                'house' => $data['house'],
                'zipcode' => $data['zipcode'],
                ] 
        );
    }

    public static function update($data, $id) {
        DB::table('addresses')
                ->where('id', $id)
                ->update([
                    'region' => $data['region'],
                    'city' => $data['city'],
                    'street' => $data['street'],
                    'house' => $data['house'],
                    'zipcode' => $data['zipcode'],
                ]);
    }

    public static function delete($id) {
        DB::table('addresses')->where('id', $id)->delete();
    }
}
