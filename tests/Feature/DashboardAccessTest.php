<?php

<<<<<<< HEAD
namespace Tests\Feature;

=======
<<<<<<< HEAD
namespace Tests\Feature;

=======
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardAccessTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
    /**
     * A basic feature test example.
     */
    public function test_dashboard_is_accessible_for_logged_in_user(): void
<<<<<<< HEAD
=======
=======
    /** @test */
    public function unauthenticated_users_are_redirected_to_login()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_access_the_dashboard()
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }
<<<<<<< HEAD
} 
=======
<<<<<<< HEAD
} 
=======
}
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
