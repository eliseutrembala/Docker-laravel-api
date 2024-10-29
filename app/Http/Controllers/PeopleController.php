<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeopleRequest;
use Illuminate\Http\Request;
use App\Models\People;

class PeopleController extends Controller
{
    public function list()
    {
        return People::paginate(15); 
    }

    public function store(StorePeopleRequest $people) {
        return true;
    }
}