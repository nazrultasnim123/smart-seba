<?php

use Illuminate\\Support\\Facades\\Route;
use App\\Http\\Controllers\\SmartFriendChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/smartfriend', [SmartFriendChatController::class, 'index']);
Route::post('/smartfriend/chat', [SmartFriendChatController::class, 'chat']);
