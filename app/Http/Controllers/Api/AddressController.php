<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;

class AddressController extends Controller
{
    public function store(StoreAddressRequest $request) {
        $data = $request->validated();

        if(count(User::getById($data['user_id']))) {
            Address::store($data);
        } else {
            return 'user with ID ' . $data['user_id'] . ' not found';
        }
    }

    public function update(UpdateAddressRequest $request, $id) {
        $data = $request->validated();

        if(count(Address::getById($id))) {
            Address::update($data, $id);
        } else {
            return 'address with ID ' . $id . ' not found';
        }
    }

    public function delete($id) {
        if(count(Address::getById($id))) {
            Address::delete($id);
        } else {
            return 'address with ID ' . $id . ' not found';
        }
    }
}
