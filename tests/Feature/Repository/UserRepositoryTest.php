<?php

namespace Tests\Feature\Repository;

use App\Exceptions\CreateDuplicateModelException;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    protected UserRepository $repository;
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(UserRepository::class);
        $this->user = User::factory(1)->create()->first();
    }


    public function test_find_by_email()
    {
        $foundUser = $this->repository->findByEmail($this->user->email)->first();
        $this->assertEquals($this->user->id, $foundUser->id);
    }

    public function test_create_success()
    {
        $createdUser = $this->repository->create([
            'name' => 'Test name',
            'email' => 'test@mail.org',
            'password' => 'password',
        ]);
        $this->assertDatabaseHas('users', $createdUser->only(['name', 'email']));
    }

    public function test_create_duplicate_email()
    {
        $this->expectException(CreateDuplicateModelException::class);
        $this->repository->create(array_merge($this->user->only(['name', 'email'], ['password' => 'password'])));
    }
}
