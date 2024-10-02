<?php

use App\Http\Controllers\OperationTenantController;
use App\Http\Controllers\TenantController;
use App\Http\Middleware\CheckTenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Tenant operations
Route::get('list-users',[OperationTenantController::class,'index']);
Route::post('add-user',[OperationTenantController::class,'store']);
Route::get('show-user/{id}',[OperationTenantController::class,'show']);




// Central operations
Route::get('/tenants', [TenantController::class,'index']);
Route::get('/tenant/{id}', [TenantController::class,'show']);
Route::post('/tenant', [TenantController::class,'store']);
Route::put('/tenant/{id}', [TenantController::class,'update']);
Route::delete('/tenant/{id}', [TenantController::class,'destroy']);

Route::get('get-users',function(){
    $users = User::all();
    if($users->isEmpty()){
        return response()->json(['message'=>'No users found'],404);
    }
    return $users;
});
Route::post('add-users',function(Request $request){
   $user  = User::create($request->all());
   return $user;
});


