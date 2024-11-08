<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function showChat($sellerId)
    {
        $seller = User::findOrFail($sellerId);
        $buyer = auth()->user();
        $messages = Message::where(function ($query) use ($buyer, $seller) {
                $query->where('sender_id', $buyer->id)->where('receiver_id', $seller->id);
            })
            ->orWhere(function ($query) use ($buyer, $seller) {
                $query->where('sender_id', $seller->id)->where('receiver_id', $buyer->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('front.pages.chat-with-seller', compact('seller', 'messages'));
    }

    public function sendMessage(Request $request, $sellerId)
    {
        $buyer = auth()->user();

        Message::create([
            'sender_id' => $buyer->id,
            'receiver_id' => $sellerId,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}

