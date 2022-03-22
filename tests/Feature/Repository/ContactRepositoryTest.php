<?php

namespace Tests\Feature\Repository;

use App\Repositories\ContactRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContactRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected ContactRepository $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(ContactRepository::class);
    }

    public function test_format_phone_to_search()
    {
        $cases = [
            '79232528636' => '+79232528636',
            '89232528636' => '+79232528636',
            '9232528636' => '9232528636',
            '+7 (923) 252-86-36' => '+79232528636',
        ];
        foreach ($cases as $arg => $expected) {
            $this->assertEquals($expected, $this->repository->formatPhoneToSearch($arg), 'arg: ' . $arg);
        }
    }
}
