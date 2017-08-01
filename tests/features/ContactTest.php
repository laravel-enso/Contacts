<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\Contacts\app\Models\Contact;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use DatabaseMigrations;

    private $user;
    private $faker;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
        $this->user = User::first();
        $this->faker = Factory::create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function index()
    {
        $response = $this->get('/administration/contacts');
        $response->assertStatus(200);
    }

    /** @test */
    public function create()
    {
        $response = $this->get('/administration/contacts/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function store()
    {
        $response = $this->post('/administration/contacts', $this->postParams());
        $contact = Contact::first(['id']);
        $response->assertRedirect('/administration/contacts/'.$contact->id.'/edit');
        $this->hasSessionConfirmation($response);
        $this->assertTrue($this->wasCreated());
    }

    /** @test */
    public function edit()
    {
        Contact::create($this->postParams());
        $contact = Contact::first();
        $response = $this->get('/administration/contacts/'.$contact->id.'/edit');
        $response->assertStatus(200);
        $response->assertViewHas('contact', $contact);
    }

    /** @test */
    public function update()
    {
        Contact::create($this->postParams());
        $contact = Contact::first();
        $contact['first_name'] = 'edited';
        $contact['_method'] = 'PATCH';
        $response = $this->patch('/administration/contacts/'.$contact->id, $contact->toArray());
        $response->assertStatus(302);
        $this->hasSessionConfirmation($response);
        $this->assertTrue($this->wasUpdated());
    }

    /** @test */
    public function destroy()
    {
        Contact::create($this->postParams());
        $contact = Contact::first(['id']);
        $response = $this->delete('/administration/contacts/'.$contact->id);
        $this->hasJsonConfirmation($response);
        $response->assertStatus(200);
    }

    private function wasCreated()
    {
        return Contact::count() === 1;
    }

    private function wasUpdated()
    {
        $contact = Contact::first(['first_name']);

        return $contact->first_name === 'edited';
    }

    private function hasJsonConfirmation($response)
    {
        return $response->assertJsonFragment(['message']);
    }

    private function hasSessionConfirmation($response)
    {
        return $response->assertSessionHas('flash_notification');
    }

    private function postParams()
    {
        return [
            'owner_id'   => 1,
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'email'      => $this->faker->email,
            'is_active'  => 1,
            '_method'    => 'POST',
        ];
    }
}
