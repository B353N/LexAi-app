<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\User;
use App\Models\Chat;

class ChatFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function user_can_send_a_message_and_get_an_ai_response()
    {
        $chat = Chat::factory()->create();

        \Prism\Prism\Facades\Prism::shouldReceive('text')->once()->andReturn((object)[
            'choices' => [
                (object)[
                    'message' => (object)[
                        'content' => 'This is the AI response.'
                    ]
                ]
            ],
            'usage' => (object)[
                'prompt_tokens' => 10,
                'completion_tokens' => 20,
                'total_tokens' => 30,
            ]
        ]);

        $response = $this->post(route('chat.messages.store', $chat), ['message' => 'Hello, AI!']);

        $response->assertRedirect(route('chat.show', $chat));

        $this->assertDatabaseHas('messages', [
            'chat_id' => $chat->id,
            'role' => 'user',
            'content' => 'Hello, AI!',
        ]);

        $this->assertDatabaseHas('messages', [
            'chat_id' => $chat->id,
            'role' => 'assistant',
            'content' => 'This is the AI response.',
        ]);
    }
}
