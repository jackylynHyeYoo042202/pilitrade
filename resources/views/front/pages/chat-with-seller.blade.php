@extends('front.layout.pages-layout')

@section('pageTitle', 'Chat with ' . $seller->name)

@section('content')
<div class="container py-5">
    <h2>Chat with {{ $seller->name }}</h2>
    <div id="chat-box" class="mb-4" style="border: 1px solid #ddd; padding: 15px; max-height: 400px; overflow-y: scroll;">
        @foreach($messages as $message)
            <div class="{{ $message->sender_id == auth()->id() ? 'text-end' : '' }}">
                <strong>{{ $message->sender_id == auth()->id() ? 'You' : $seller->name }}:</strong>
                <p>{{ $message->message }}</p>
            </div>
        @endforeach
    </div>
    <form action="{{ route('chat.sendMessage', $seller->id) }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Type your message...">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
@endsection
