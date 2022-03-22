<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use DatabaseTransactions;

    const CONTACT_NAME = 'TEST NAME';
    const CONTACT_PHONE = '+79232528646';
    const CONTACT_PHONE_FORMATTED = '8 (923) 252-86-46';

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::findByEmail(self::ADMIN['email']));
        Contact::factory()
            ->create(['name' => self::CONTACT_NAME]);
        Phone::factory()->create(['phone' => self::CONTACT_PHONE]);
    }

    public function test_index_success()
    {
        $response = $this->get(route('contacts.index'));
        $response->assertStatus(200);
    }

    public function test_index_search_name()
    {
        $response = $this->getJson(route('contacts.index', ['name' => self::CONTACT_NAME]))->json();
        $this->assertTrue(collect($response)->every(fn($item) => $item['name'] == self::CONTACT_NAME));
    }

    public function test_index_search_author()
    {
        $response = $this->getJson(route('contacts.index', ['author' => self::ADMIN['name']]))->json();
        $this->assertTrue(collect($response)->every(fn($item) => $item['author'] == self::ADMIN['name']));
    }

    public function test_index_search_phone()
    {
        $response = $this->getJson(route('contacts.index', ['phone' => self::CONTACT_PHONE]))->json();
        $this->assertTrue(collect($response)->every(fn($item) => in_array(self::CONTACT_PHONE_FORMATTED, $item['phones'])));
    }
}
