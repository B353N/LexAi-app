<?php

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
namespace Tests\Feature;

use App\Models\User;
use App\Models\Chat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
<<<<<<< HEAD
=======
=======
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\User;
use App\Models\Chat;
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3

class ChatFunctionalityTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_create_a_new_chat(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('chat.store'));

        $this->assertDatabaseHas('chats', [
            'user_id' => $user->id,
            'title' => 'New Chat',
        ]);

        $chat = Chat::where('user_id', $user->id)->first();
        $response->assertRedirect(route('chat.show', $chat));
    }

    public function test_user_can_send_a_message_and_receive_a_response(): void
    {
        $user = User::factory()->create();
        $chat = Chat::factory()->create(['user_id' => $user->id]);

        $textGeneratorMock = $this->mock(\Prism\Prism\Contracts\TextGenerator::class);

        $mockedResponse = new \stdClass();
        $mockedResponse->text = 'This is a mocked AI response.';

        $textGeneratorMock->shouldReceive('using')->andReturnSelf();
        $textGeneratorMock->shouldReceive('withMessages')->andReturnSelf();
        $textGeneratorMock->shouldReceive('asText')->andReturn($mockedResponse);

        \Prism\Prism\Facades\Prism::shouldReceive('text')
            ->once()
            ->andReturn($textGeneratorMock);

        $response = $this->actingAs($user)->post(route('chat.messages.store', $chat), [
            'message' => 'Hello, AI!',
        ]);
<<<<<<< HEAD
=======
=======
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
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3

        $response->assertRedirect(route('chat.show', $chat));

        $this->assertDatabaseHas('messages', [
            'chat_id' => $chat->id,
            'role' => 'user',
            'content' => 'Hello, AI!',
        ]);

        $this->assertDatabaseHas('messages', [
            'chat_id' => $chat->id,
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
            'role' => 'ai',
            'content' => 'This is a mocked AI response.',
        ]);

        $this->assertCount(2, $chat->refresh()->messages);
<<<<<<< HEAD
=======
=======
            'role' => 'assistant',
            'content' => 'This is the AI response.',
        ]);
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
    }
}
