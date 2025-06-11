<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
<<<<<<< HEAD
use Prism\Prism\Prism;
=======
use Prism\Prism\Facades\Prism;
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
use Prism\Prism\ValueObjects\Messages\UserMessage;
use Prism\Prism\ValueObjects\Messages\AssistantMessage;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $chats = $request->user()->chats()->latest()->get();

        return Inertia::render('Chat/Index', [
            'chats' => $chats,
            'activeChat' => $chats->first() ? $this->loadChat($chats->first()) : null,
        ]);
    }

    public function show(Request $request, Chat $chat)
    {
        $chats = $request->user()->chats()->latest()->get();

        return Inertia::render('Chat/Index', [
            'chats' => $chats,
            'activeChat' => $this->loadChat($chat),
        ]);
    }

    private function loadChat(Chat $chat)
    {
        $chat->load('messages');
        return $chat;
    }

    public function storeMessage(Request $request, Chat $chat)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:4096'],
        ]);

        $chat->messages()->create([
            'role' => 'user',
            'content' => $validated['message'],
        ]);

        // If this is the first message, set the chat title
        if ($chat->messages()->count() === 1) {
            $chat->update(['title' => Str::limit($validated['message'], 30)]);
        }

        $this->generateAiResponse($chat);

        return redirect()->route('chat.show', $chat);
    }

    private function generateAiResponse(Chat $chat): void
    {
        $response = Prism::text()
<<<<<<< HEAD
            ->using('gemini', 'gemini-2.0-flash')
=======
            ->using(config('prism.default_text_model.provider'), config('prism.default_text_model.model'))
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
            ->withMessages($chat->messages->map(function ($message) {
                return $message->role === 'user'
                    ? new UserMessage($message->content)
                    : new AssistantMessage($message->content);
            })->all())
            ->asText();

        $chat->messages()->create([
            'role' => 'ai',
            'content' => $response->text,
        ]);
    }

    public function store(Request $request)
    {
        $chat = $request->user()->chats()->create([
            'title' => 'New Chat',
        ]);

        return redirect()->route('chat.show', $chat);
    }
}
