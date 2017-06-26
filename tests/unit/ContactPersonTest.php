<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\ContactPersons\app\Models\ContactPerson;
use Tests\TestCase;

class ContactPersonTest extends TestCase
{
    use DatabaseMigrations;

    private $user;
    private $faker;

    protected function setUp()
    {
        parent::setUp();

        // $this->disableExceptionHandling();
        $this->user = User::first();
        $this->faker = Factory::create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function index()
    {
        $response = $this->get('/administration/contactPersons');
        $response->assertStatus(200);
    }

    /** @test */
    public function create()
    {
        $response = $this->get('/administration/contactPersons/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function store()
    {
        $response = $this->post('/administration/contactPersons', $this->postParams());
        $contactPerson = ContactPerson::first(['id']);
        $response->assertRedirect('/administration/contactPersons/'.$contactPerson->id.'/edit');
        $this->hasSessionConfirmation($response);
        $this->assertTrue($this->wasCreated());
    }

    /** @test */
    public function edit()
    {
        ContactPerson::create($this->postParams());
        $contactPerson = ContactPerson::first();
        $response = $this->get('/administration/contactPersons/'.$contactPerson->id.'/edit');
        $response->assertStatus(200);
        $response->assertViewHas('contactPerson', $contactPerson);
    }

    /** @test */
    public function update()
    {
        ContactPerson::create($this->postParams());
        $contactPerson = ContactPerson::first();
        $contactPerson['first_name'] = 'edited';
        $contactPerson['_method'] = 'PATCH';
        $response = $this->patch('/administration/contactPersons/'.$contactPerson->id, $contactPerson->toArray());
        $response->assertStatus(302);
        $this->hasSessionConfirmation($response);
        $this->assertTrue($this->wasUpdated());
    }

    /** @test */
    public function destroy()
    {
        ContactPerson::create($this->postParams());
        $contactPerson = ContactPerson::first(['id']);
        $response = $this->delete('/administration/contactPersons/'.$contactPerson->id);
        $this->hasJsonConfirmation($response);
        $response->assertStatus(200);
    }

    private function wasCreated()
    {
        return ContactPerson::count() === 1;
    }

    private function wasUpdated()
    {
        $contactPerson = ContactPerson::first(['first_name']);

        return $contactPerson->first_name === 'edited';
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
