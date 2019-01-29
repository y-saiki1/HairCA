<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Do not need JWT
Route::middleware(['api'])->group(function () {
    // Auth
    Route::namespace('Auth')->group(function () {
        Route::post('/auth/login', 'LoginAction');
    });
    
    // Base
    Route::namespace('Bases')->group(function () {
        Route::get('/bases', 'IndexAction');
    });

    // Stylist
    Route::namespace('Accounts\\Stylists')->group(function () {
        Route::post('/accounts/stylists',        'CreateStylistAction');
        Route::post('/accounts/stylists/auth',   'AuthenticateInvitationAction');
    });
});

// Need JWT 
Route::middleware(['api', 'auth:api'])->group(function () {
    // Stylist
    Route::namespace('Accounts\\Stylists')->group(function () {
        Route::post('/accounts/stylists/invite', 'InviteAction');
        Route::post('/accounts/stylists/profiles', 'CreateStylistProfileAction');
    });
});
