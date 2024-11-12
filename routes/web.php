<?php

use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\PeopleController;
use App\Http\Middleware\JWTMiddleware;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Contracts\Providers\JWT;

Route::get('/', function () {
    return response()->json([
        'message' => 'OK'
    ]);
});


Route::get('/somar', function (Request  $request) {
    if (count($request->all()) < 1) {
        return response()->json([
            'message' => 'Não há valores para somar.'
        ], 406);
    }
    $soma = array_sum($request->all());
    return response()->json([
        'message' => 'somado com sucesso',
        'sum' => $soma,
    ]);
});
 
Route::prefix('/people')->middleware([JWTMiddleware::class])->group(function() {

    Route::get('/list',  [PeopleController::class, 'list']);

    Route::post('/store', [PeopleController::class, 'store']);

    Route::post('/storeInterest', [PeopleController::class, 'storeInterest']);

});

Route::prefix('/user')->group(function() {
    Route::post('register', [JWTAuthController::class, 'register']);

    Route::post('/login', [JWTAuthController::class, 'login']);

    Route::middleware([JWTMiddleware::class])->get('/logout', [JWTAuthController::class, 'logout']);
});