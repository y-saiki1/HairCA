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

Route::group(['middleware' => 'api'], function ($router) {
    // Account
    Route::post('/auth/login', 'Auth\\LoginAction');

    // Stylist
    Route::post('/accounts/stylists',        'Accounts\\Stylists\\CreateStylistAction');
    Route::post('/accounts/stylists/invite', 'Accounts\\Stylists\\InviteAction')->middleware('auth:api');
    Route::post('/accounts/stylists/auth',   'Accounts\\Stylists\\AuthenticateInvitationAction');
    
    // StylistProfile
    Route::post('/accounts/stylists/profiles', 'Accounts\\Stylists\\CreateStylistProfileAction')->middleware('auth:api');
});
