<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        $result = [];

        foreach($users as $user) {
            $addresses = Address::getByUserId($user->id);

            $result[] = [
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'subscribe' => $user->subscribe,
                'addresses' => $addresses
             ];
        }

        return response()->json([
            'status' => 200,
            'users' => $result,
        ], 200);
    }

    public function getById($id) {

        if(count(User::getById($id))) {
            $user = User::getById($id);
        } else {
            return 'user with ID ' . $id . ' not found';
        }
        $addresses = Address::getByUserId($id);

        return response()->json([
            'status' => 200,
            'user' => $user,
            'address' => $addresses
        ], 200);
    }

    public function update(UpdateUserRequest $request, $id) {
        $data = $request->validated();

        User::update($data, $id);
    }
    
}
