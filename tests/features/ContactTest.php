<?php

use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\Contacts\app\Traits\Contactable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\FormBuilder\app\TestTraits\CreateForm;
use LaravelEnso\VueDatatable\app\Traits\Tests\Datatable;

class ContactTest extends TestCase
{
    use CreateForm, Datatable, RefreshDatabase;

    private $permissionGroup = 'core.contacts';
    private $testModel;

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->model = $this->model();
        $this->testModel = factory(Contact::class)
            ->make([
                'contactable_id' => $this->model->id,
                'contactable_type' => get_class($this->model),
            ]);
    }

    /** @test */
    public function can_get_contacts_index()
    {
        $this->testModel->save();

        $this->get(route('core.contacts.index', [
            'contactable_type' => get_class($this->model),
            'contactable_id' => $this->model->id
        ], false))
            ->assertStatus(200)
            ->assertJsonFragment(['id' => $this->model->id]);
    }

    /** @test */
    public function can_store_contact()
    {
        $this->post(
            route('core.contacts.store', [], false),
            $this->testModel->toArray() + [
                '_params' => [
                'contactable_id' => $this->model->id,
                'contactable_type' => get_class($this->model),
            ]]
        )->assertStatus(200);

        $contact = Contact::whereFirstName($this->testModel->first_name)
            ->first();

        $this->assertNotNull($contact);
    }

    /** @test */
    public function can_update_contact()
    {
        $this->testModel->save();
        $this->testModel->first_name = 'edited';

        $this->patch(
            route('core.contacts.update', $this->testModel->id, false),
            $this->testModel->toArray()
        )->assertStatus(200);

        $this->assertEquals('edited', $this->testModel->fresh()->first_name);
    }

    /** @test */
    public function can_destroy_contact()
    {
        $this->testModel->save();

        $this->delete(route('core.contacts.destroy', $this->testModel->id, false))
            ->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertNull($this->testModel->fresh());
    }

    private function model()
    {
        $this->createTestTable();

        return ContactTestModel::create(['name' => 'contactable']);
    }

    private function createTestTable()
    {
        Schema::create('contact_test_models', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }
}

class ContactTestModel extends Model
{
    use Contactable;

    protected $fillable = ['name'];
}
