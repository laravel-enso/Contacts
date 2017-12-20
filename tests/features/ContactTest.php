<?php

use App\Owner;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\TestHelper\app\Traits\SignIn;
use LaravelEnso\TestHelper\app\Traits\TestDataTable;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase, SignIn, TestDataTable;

    private $owner;
    private $faker;
    private $prefix = 'core.contacts';

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();
        $this->signIn(User::first());
        $this->owner = Owner::first();
        $this->faker = Factory::create();
    }

    /** @test */
    public function list()
    {
        $contact = $this->createContact();

        $this->call('GET', route('core.contacts.list', [], false), [
            'id' => $this->owner->id,
            'type' => 'owner',
        ])->assertStatus(200)
            ->assertJson([$contact->toArray()]);
    }

    /** @test */
    public function store()
    {
        $postParams = $this->postParams();

        $this->post(route('core.contacts.store', [], false), $postParams)
            ->assertStatus(200);

        $contact = Contact::whereFirstName($postParams['contact']['first_name'])->first();

        $this->assertNotNull($contact);
    }

    /** @test */
    public function update()
    {
        $contact = $this->createContact();
        $contact->first_name = 'edited';

        $this->patch(route('core.contacts.update', $contact->id, false), [
            'contact' => $contact->toArray(),
        ])->assertStatus(200);

        $this->assertEquals('edited', $contact->fresh()->first_name);
    }

    /** @test */
    public function destroy()
    {
        $contact = $this->createContact();

        $this->delete(route('core.contacts.destroy', $contact->id, false))
            ->assertStatus(200)
            ->assertJsonFragment(['message']);

        $this->assertNull($contact->fresh());
    }

    private function createContact()
    {
        $data = $this->postParams();
        $contact = new Contact($data['contact']);
        $this->owner->contacts()->save($contact);

        return $contact->fresh();
    }

    private function postParams()
    {
        return [
            'type' => 'owner',
            'id' => $this->owner->id,
            'contact' => [
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'email' => $this->faker->email,
                'is_active' => 1,
            ],
        ];
    }
}
