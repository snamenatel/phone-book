<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;
    const USER_EMAIL = 'test@test.test';
    const USER_NAME = 'Testing User Name';
    const USER_PASSWORD = 'password';

    public function setUp(): void
    {
        parent::setUp();
        User::factory(1)->create([
            'name' => self::USER_NAME,
            'email' => self::USER_EMAIL,
            'password' => Hash::make(self::USER_PASSWORD),
        ]);
    }

    public function test_login_success()
    {
        $this->post(route('login'), [
            'email' => self::USER_EMAIL,
            'password' => self::USER_PASSWORD,
        ])->assertStatus(Response::HTTP_OK);
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs(User::where('email', self::USER_EMAIL)->first());
    }

    public function test_login_wrong()
    {
        $this->post(route('login'), [
            'email' => 'not@exisiting.mail',
            'password' => 'notExistingPassword'
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->post(route('login'), [
            'email' => self::USER_EMAIL,
            'password' => 'notExistingPassword'
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_logout()
    {
        $this->actingAs(User::first());
        $this->post(route('logout'))->assertStatus(Response::HTTP_OK);
        $this->assertNull(Auth::user());
    }

    public function test_password_reset()
    {
        $this->post(route('password.forget'), ['email' => self::USER_EMAIL])->assertStatus(Response::HTTP_OK);
        $email = DB::table('password_resets')->latest()->value('email');
        $this->assertEquals(self::USER_EMAIL, $email);
    }

    public function test_password_reset_show()
    {
        [ 'email' => $email,'token' => $token] = $this->get(route('password.reset', ['email' => self::USER_EMAIL, 'token' => 'user_token']));
        $this->assertEquals(self::USER_EMAIL, $email);
        $this->assertEquals('user_token', $token);
    }
}
