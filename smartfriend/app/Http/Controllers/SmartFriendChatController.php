<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SmartFriendChatController extends Controller
{
    /**
     * Display the Smart Friend chat page.
     */
    public function index(): View
    {
        return view('smartfriend.chat');
    }

    /**
     * Handle an incoming chat message.
     */
    public function chat(Request $request): JsonResponse
    {
        $message = $request->input('message');

        return response()->json([
            'message' => 'Hello from Smart Friend!',
            'request' => $message,
        ]);
    }
}
