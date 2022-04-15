<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    public function test_user_can_login()
    {
        $this->withoutExceptionHandling();

        //Environment Setup
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('test')
        ]);
        $this->assertDatabaseHas('users', [
            'id' => 1,
            'email' => 'test@test.com',
        ]);
        $this->assertGuest();

        //Behavior
        $response = $this->postJson('/login', [
            'email' => 'test@test.com',
            'password' => 'test',
            'device' => 'test'
        ]);

        //Assertions
        $this->assertEquals(1, Auth::user()->id);
    }
}
