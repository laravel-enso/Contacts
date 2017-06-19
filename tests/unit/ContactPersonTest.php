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
    public function create()
    {
        $response = $this->post('/administration/contactPersons', $this->postParams());
        $this->assertTrue($this->wasCreated());
        $contactPerson = ContactPerson::first();
        $response->assertRedirect('/administration/contactPersons/'.$contactPerson->id.'/edit');
    }

    /** @test */
    public function index()
    {
        $response = $this->get('/administration/contactPersons');
        $response->assertStatus(200);
    }

    /** @test */
    public function update()
    {
        $data = $this->postParams();
        $response = $this->post('/administration/contactPersons', $data);
        $data['first_name'] = 'edited';
        $data['_method'] = 'PATCH';
        $response = $this->patch('/administration/contactPersons/1', $data);

        $response->assertStatus(302);
        $this->assertTrue($this->wasEdited());
    }

    /** @test */
    public function destroy()
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

    private function wasCreated()
    {
        return ContactPerson::count() === 1;
    }

    private function wasEdited()
    {
        $contactPerson = ContactPerson::first();

        return $contactPerson->first_name === 'edited';
    }
}
