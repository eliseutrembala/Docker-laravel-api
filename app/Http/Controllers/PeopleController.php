<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterestRequest;
use App\Http\Requests\StorePeopleRequest;
use Illuminate\Http\Request;
use App\Models\People;

class PeopleController extends Controller
{
    public function list()
    {
        return People::with('interests')->paginate(15); 
    }

    public function store(StorePeopleRequest $people) {
        $newPeople = People::create($people->all());
        if ($newPeople) {
            return response()->json([
                'messsage' => 'Nova pessoa criada com sucesso',
                'people' => $newPeople,
            ]);
        } else {
            return response()->json([
                'message' => 'Deu ruim. Te vira ai para descobrir o que aconteceu.'
            ], 422);
        }
    }
    public function storeInterest(StoreInterestRequest $interest) {
       return true;
    }
}


