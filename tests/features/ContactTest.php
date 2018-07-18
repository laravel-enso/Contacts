<?php

use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\TestHelper\app\Traits\SignIn;
use LaravelEnso\Contacts\app\Traits\Contactable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\TestHelper\app\Traits\TestDataTable;

class ContactTest extends TestCase
{
    use RefreshDatabase, SignIn, TestDataTable;

    private $contactTestModel;
    private $faker;
    private $prefix = 'core.contacts';

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();
        $this->signIn(User::first());
        $this->faker = Factory::create();

        $this->createContactTestModelsTable();
        $this->contactTestModel = $this->createContactTestModel();

        config(['enso.contacts.contactables' => ['contactTestModel' => 'ContactTestModel']]);
    }

    /** @test */
    public function index()
    {
        $contact = $this->createContact();

        $this->get(route('core.contacts.index', [
            'contactable_type' => 'contactTestModel', 'contactable_id' => $this->contactTestModel->id
        ], false))
            ->assertStatus(200)
            ->assertJson([$contact->toArray()]);
    }

    /** @test */
    public function store()
    {
        $postParams = $this->postParams();

        $this->post(route('core.contacts.store', [], false), $postParams)
            ->assertStatus(200);

        $contact = Contact::whereFirstName($postParams['first_name'])->first();

        $this->assertNotNull($contact);
    }

    /** @test */
    public function update()
    {
        $contact = $this->createContact();
        $contact->first_name = 'edited';

        $this->patch(
            route('core.contacts.update', $contact->id, false),
            $contact->toArray()
        )->assertStatus(200);

        $this->assertEquals('edited', $contact->fresh()->first_name);
    }

    /** @test */
    public function destroy()
    {
        $contact = $this->createContact();

        $this->delete(route('core.contacts.destroy', $contact->id, false))
            ->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertNull($contact->fresh());
    }

    private function createContact()
    {
        $contact = new Contact($this->postParams());
        $this->contactTestModel->contacts()->save($contact);

        return $contact->fresh();
    }

    private function postParams()
    {
        return [
            '_params' => [
                'contactable_type' => 'contactTestModel',
                'contactable_id' => $this->contactTestModel->id,
            ],
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'is_active' => 1,
        ];
    }

    private function createContactTestModelsTable()
    {
        Schema::create('contact_test_models', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    private function createContactTestModel()
    {
        return ContactTestModel::create(['name' => 'contactable']);
    }
}

class ContactTestModel extends Model
{
    use Contactable;

    protected $fillable = ['name'];
}
