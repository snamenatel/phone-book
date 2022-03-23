<?php

namespace Tests\Feature;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use DatabaseTransactions;

    const CONTACT_NAME = 'TEST NAME';
    const CONTACT_PHONE = '+79232528646';
    const CONTACT_PHONE_FORMATTED = '8 (923) 252-86-46';
    const NOT_EXISTING_PHONE = '+79231931931';
    const NOT_EXISTING_PHONE_FORMATTED = '8 (923) 193-19-31';

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

    public function test_store_success()
    {
        $response = $this->postJson(route(
                'contacts.store', [
                'name' => self::CONTACT_NAME,
                'phone' => [self::NOT_EXISTING_PHONE]
            ])
        )->json();
        $this->assertTrue($response['data']['phones'][0] == self::NOT_EXISTING_PHONE_FORMATTED);
    }

    public function test_store_wrong_request()
    {
        $response = $this->postJson(route('contacts.store', ['name' => self::CONTACT_NAME]));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_store_wrong_duplicate()
    {
        $this->postJson(route('contacts.store', [
                'name' => self::CONTACT_NAME, 'phone' => [self::CONTACT_PHONE]])
        )->assertStatus(500);
    }

    public function test_show_success()
    {
        $contact = Contact::with(['phones', 'author'])->orderByDesc('id')->first();
        $response = $this->getJson(route('contacts.show', ['contact' => $contact->id]));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['name' => $contact->name]);
        $response->assertJsonFragment(['author' => $contact->author->name]);
    }

    public function test_show_not_found()
    {
        $id = Contact::orderByDesc('id')->value('id');
        $response = $this->getJson(route('contacts.show', ['contact' => ++$id]));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

}
