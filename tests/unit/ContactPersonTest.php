<?php

use App\Owner;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\ContactPersons\app\Models\ContactPerson;
use Tests\TestCase;

class ContactPersonTest extends TestCase
{
    use DatabaseMigrations;

    private $faker;

    protected function setUp()
    {
        parent::setUp();

        // $this->disableExceptionHandling();
        $this->faker = Factory::create();
        $this->actingAs(User::first());
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
        $postParams = $this->postParams();
        $response = $this->post('/administration/contactPersons', $postParams);
        $contactPerson = ContactPerson::whereFirstName($postParams['first_name'])->first(['id']);

        $response->assertRedirect('/administration/contactPersons/'.$contactPerson->id.'/edit');

        $this->hasSessionConfirmation($response);
        $this->assertTrue(ContactPerson::whereFirstName($postParams['first_name'])->count() === 1);
    }

    /** @test */
    public function edit()
    {
        $postParams = $this->postParams();
        ContactPerson::create($postParams);
        $contactPerson = ContactPerson::whereFirstName($postParams['first_name'])->first();

        $response = $this->get('/administration/contactPersons/'.$contactPerson->id.'/edit');

        $response->assertStatus(200);
        $response->assertViewHas('contactPerson', $contactPerson);
    }

    /** @test */
    public function update()
    {
        $postParams = $this->postParams();
        ContactPerson::create($postParams);
        $contactPerson = ContactPerson::whereFirstName($postParams['first_name'])->first();
        $contactPerson['first_name'] = 'edited';
        $contactPerson['_method'] = 'PATCH';

        $response = $this->patch('/administration/contactPersons/'.$contactPerson->id, $contactPerson->toArray());

        $response->assertStatus(302);
        $this->hasSessionConfirmation($response);
        $this->assertTrue(ContactPerson::whereFirstName('edited')->count() === 1);
    }

    /** @test */
    public function destroy()
    {
        $postParams = $this->postParams();
        ContactPerson::create($postParams);
        $contactPerson = ContactPerson::whereFirstName($postParams['first_name'])->first(['id']);

        $response = $this->delete('/administration/contactPersons/'.$contactPerson->id);

        $this->hasJsonConfirmation($response);
        $this->assertTrue(ContactPerson::whereFirstName($postParams['first_name'])->count() === 0);
        $response->assertStatus(200);
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
            'owner_id'   => Owner::first(['id'])->id,
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'email'      => $this->faker->email,
            'is_active'  => 1,
            '_method'    => 'POST',
        ];
    }
}
