<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

// Route::get('/setup', function () {
//     $credentials = [
//         'email' => 'admin@gmail.com',
//         'password' => '12345678'
//     ];

//     if(!Auth::attempt($credentials)){
//         $user = new User();

//         $user->name = 'admin';
//         $user->email = $credentials['email'];
//         $user->password = Hash::make($credentials['password']);

//         $user->save();

//         if(Auth::attempt($credentials)){
//             $user = Auth::user();

//             $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
//             $updateToken = $user->createToken('update-token', ['create', 'update']);
//             $basicToken = $user->createToken('basic-token');

//             return [
//                 'admin' => $adminToken->plainTextToken,
//                 'update' => $updateToken->plainTextToken,
//                 'basic' => $basicToken->plainTextToken,
//             ];
//         }
//     }
// });

Route::view('/customers', 'page.customers');
