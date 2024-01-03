<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        // ユーザーの作成
        User::factory()->create([
            'password' => Hash::make('password')
        ]);

        Artisan::call('passport:install');
    }

    /**
     * テスト成功
     *
     * @return void
     */
    public function testLogin(): void
    {
        $user = User::first();

        $user_data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->post('/api/users/login', $user_data);
        $response->assertStatus(200);
        $token = $response['token'];
        $response->assertJsonFragment([
            "token" => $token,
        ]);

        //ユーザー情報を取得できる
        $response = $this->getJson('/api/users', [
            'Authorization' => 'Bearer ' . $token,
        ]);
        $response->assertStatus(200)
        ->assertJsonFragment([
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "image_url" => $user->image_url,
            "created_at" =>  $user->created_at,
            "updated_at" =>  $user->updated_at
        ]);
    }

    /**
     * テスト失敗(Eメールとパスワード不一致)
     *
     * @return void
     */
    public function testFailedLogin(): void
    {
        //正しくないユーザー情報
        $user_data = [
            'email' => 'sample@test.com',
            'password' => 'incorrect_password',
        ];

        $response = $this->post('/api/users/login', $user_data);
        $response->assertStatus(401);
        $response->assertJsonFragment([
            'message' => 'Unauthorized',
        ]);
    }

    /**
     * テスト失敗(バリデーションエラー)
     *
     * @return void
     */
    public function testFailedLoginValidation(): void
    {
        //空のユーザー情報
        $user_data = [
            'email' => '',
            'password' => '',
        ];

        $response = $this->post('/api/users/login', $user_data);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'email' => ['Eメールは必ず指定してください。'],
            'password' => ['パスワードは必ず指定してください。']
        ]);
    }
}
