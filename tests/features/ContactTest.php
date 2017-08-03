<?php

use App\Owner;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\TestHelper\app\Classes\TestHelper;

class ContactTest extends TestHelper
{
    use DatabaseMigrations;

    private $owner;
    private $faker;

    protected function setUp()
    {
        parent::setUp();

        // $this->disableExceptionHandling();
        $this->owner = Owner::first();
        $this->faker = Factory::create();
        $this->signIn(User::first());
    }

    /** @test */
    public function index()
    {
        $response = $this->get('/core/contacts');

        $response->assertStatus(200);
        $response->assertViewIs('laravel-enso/contacts::index');
    }

    /** @test */
    public function list()
    {
        $contact = $this->createContact();

        $response = $this->call('GET', '/core/contacts/list/', [
            'id'   => $this->owner->id,
            'type' => 'owner',
            ]);

        $response->assertStatus(200);
        $response->assertJson([$contact->toArray()]);
    }

    /** @test */
    public function store()
    {
        $postParams = $this->postParams();

        $response = $this->post('/core/contacts', $postParams);

        $response->assertStatus(200);
        $this->assertNotNull(Contact::whereFirstName($postParams['contact']['first_name'])->first());
    }

    /** @test */
    public function update()
    {
        $contact = $this->createContact();
        $contact['first_name'] = 'edited';

        $response = $this->patch('/core/contacts/'.$contact->id, ['contact' => $contact->toArray()]);

        $response->assertStatus(200);
        $this->assertTrue($contact->fresh()->first_name === 'edited');
    }

    /** @test */
    public function destroy()
    {
        $contact = $this->createContact();

        $response = $this->delete('/core/contacts/'.$contact->id);

        $response->assertStatus(200);
        $response->assertJsonFragment(['message']);
        $this->assertNull($contact->fresh());
    }

    private function createContact()
    {
        $data = $this->postParams();
        $contact = new Contact($data['contact']);
        $contact->contactable_id = $this->owner->id;
        $contact->contactable_type = 'App\Owner';
        $contact->save();

        return $contact;
    }

    private function postParams()
    {
        return [
            'type'    => 'owner',
            'id'      => $this->owner->id,
            'contact' => [
                'first_name' => $this->faker->firstName,
                'last_name'  => $this->faker->lastName,
                'phone'      => $this->faker->phoneNumber,
                'email'      => $this->faker->email,
                'is_active'  => 1,
            ],
        ];
    }
}
