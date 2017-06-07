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

        $this->user = User::first();
        $this->faker = Factory::create();
        $this->be($this->user);
    }

    /** @test */
    public function create_contact_person()
    {
        $data = $this->postParams();
        $response = $this->post('/administration/contactPersons', $data);

        $response->assertStatus(302);
        $this->assertTrue($this->contactPersonWasCreated());
    }

    /** @test */
    public function can_get_contact_persons_index()
    {
        $response = $this->get('/administration/contactPersons');
        $response->assertStatus(200);
    }

    /** @test */
    public function update_contact_person()
    {
        $data = $this->postParams();
        $response = $this->post('/administration/contactPersons', $data);
        $data['first_name'] = 'edited';
        $data['_method'] = 'PATCH';
        $response = $this->patch('/administration/contactPersons/1', $data);

        $response->assertStatus(302);
        $this->assertTrue($this->contactPersonWasEdited());
    }

    /** @test */
    public function delete_contact_person()
    {
        $this->post('/administration/contactPersons', $this->postParams());

        $response = $this->delete('/administration/contactPersons/1');

        $response->assertStatus(200);
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

    private function contactPersonWasCreated()
    {
        return ContactPerson::all()->count() === 1;
    }

    private function contactPersonWasEdited()
    {
        $contactPerson = ContactPerson::first();

        return $contactPerson->first_name === 'edited';
    }
}
