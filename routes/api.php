<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\ContactController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// // Example API routes
// Route::get('/hello', function () {
//     return response()->json([
//         'message' => 'Hello from Laravel 11 API!',
//         'version' => '11.6.1'
//     ]);
// });

// Route::get('/status', function () {
//     return response()->json([
//         'status' => 'success',
//         'timestamp' => now()->toISOString(),
//         'environment' => app()->environment()
//     ]);
// });

// // User API routes
// Route::apiResource('users', UserController::class);

// // Product API routes
// Route::apiResource('products', ProductController::class);
// Route::get('/products/search', [ProductController::class, 'search']); 

Route::post('/contact', [ContactController::class, 'send']);
Route::post('/privatisation', [ContactController::class, 'sendPrivatisation']);
Route::get('/contact/messages', [ContactController::class, 'getAllMessages']);
Route::get('/contact/info', [ContactController::class, 'getContactInfo']);
Route::post('/generatesignature', [ContactController::class, 'generateSignature']);

// Menu Images routes
Route::post('/menu-images', [ContactController::class, 'addMenuImage']);
Route::get('/menu-images', [ContactController::class, 'getAllMenuImages']);
Route::delete('/menu-images/{id}', [ContactController::class, 'deleteMenuImage']);
Route::get('/get-contact-info', [ContactController::class, 'getContactInfo']);