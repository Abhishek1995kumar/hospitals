<?php

namespace Tests\Feature;

Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\User;
use App\Models\Customer;
use App\Models\Hospital;
use App\Models\Department;
use App\Models\Subscription;
use App\Models\Role;
use Tests\TestCase;

class CustomerRegistrationTest extends TestCase {
    use RefreshDatabase; // Har test ke baad DB clean kar dega

    protected function setUp(): void {
        parent::setUp();
        $authUser = User::factory()->create();
        $this->actingAs($authUser);

        DB::table('plans')->insert([ // Required mock plan database me insert karein
            'id'            => 1,
            'plan_name'     => 'Trial', // Trial plan test ke liye
            'price'         => 0, // Trial plan test ke liye
            'status'        => 1,
            'duration_days' => 30,
            'max_hospitals' => 5,
            'max_users'     => 10,
            'max_firms'     => 2,
            'created_at'    => now(),
            'updated_at'    => null,
        ]);
    }

    /** @test */
    public function it_successfully_registers_a_customer_creates_associated_data_and_dispatches_email_job() {
        Queue::fake(); // 1. Fake Queue so actual email isn't sent during test

        // 2. Prepare Valid Payload
        $payload = [
            'plan_name'          => 1,
            'customer_name'      => 'Dr Abhishek Mishra',
            'email'              => 'abhishek.mishra@example.com',
            'mobile_no'          => '9876543210',
            'alternate_mobile'   => '9123456789',
            'website'            => 'https://example.com',
            'country_name'       => 1,
            'state_name'         => 10,
            'city_name'          => 100,
            'address'            => '123 Health Street',
            'is_hospital_clinic' => 1,
        ];

        // Make HTTP Post Request to your registration endpoint Change '/api/customers/save' to your actual route path
        $response = $this->postJson('/api/customers/save', $payload);

        // Assert Controller Response
        $response->assertStatus(200)
                 ->assertJson([
                     'status'  => true,
                     'message' => 'Customer created successfully.'
                 ]);

        // Assert Customer Record created in DB
        $this->assertDatabaseHas('customers', [
            'customer_name' => 'Dr John Doe',
            'customer_slug' => 'dr_john_doe',
            'is_trial'      => 1,
            'current_plan_id' => 1,
        ]);

        $customer = Customer::where('customer_name', 'Dr John Doe')->first();
        $this->assertNotNull($customer);

        // Assert Hospital Record created
        $this->assertDatabaseHas('hospitals', [
            'customer_id' => $customer->id,
            'name'        => 'Dr', // First word extracted via explode
        ]);

        $hospital = Hospital::where('customer_id', $customer->id)->first();

        // Assert Department Record created
        $this->assertDatabaseHas('departments', [
            'customer_id' => $customer->id,
            'hospital_id' => $hospital->id,
            'name'        => 'Customer Administrator',
        ]);

        // Assert Customer Admin User created
        $this->assertDatabaseHas('users', [
            'customer_id' => $customer->id,
            'hospital_id' => $hospital->id,
            'fname'       => 'Dr',
            'lname'       => 'John Doe',
            'user_type'   => 3,
        ]);

        // Assert Role & Pivot UserRole entry
        $this->assertDatabaseHas('roles', [
            'customer_id' => $customer->id,
            'code'        => 'customer_admin',
        ]);

        $role = Role::where('customer_id', $customer->id)->first();
        $user = User::where('customer_id', $customer->id)->first();

        $this->assertDatabaseHas('user_roles', [
            'customer_id' => $customer->id,
            'hospital_id' => $hospital->id,
            'role_id'     => $role->id,
            'user_id'     => $user->id,
        ]);

        // Assert Subscription Record
        $this->assertDatabaseHas('subscriptions', [
            'customer_id' => $customer->id,
            'plan_id'     => 1,
            'payment_status' => 1,
        ]);

        // Assert Welcome Email Job was dispatched to Queue
        Queue::assertPushed(SendWelcomeEmailJob::class, function ($job) {
            return $job->toEmail === 'john.doe@example.com' &&
                   $job->mailData['name'] === 'Dr John Doe';
        });
    }


    public function it_rolls_back_transaction_if_plan_does_not_exist() {
        Queue::fake();

        $payload = [
            'plan_name'          => 999, // Invalid plan ID
            'customer_name'      => 'Invalid Plan User',
            'email'              => 'invalid@example.com',
            'mobile_no'          => '9876543210',
            'alternate_mobile'   => '9123456789',
            'website'            => 'https://example.com',
            'country_name'       => 1,
            'state_name'         => 10,
            'city_name'          => 100,
            'address'            => '123 Health Street',
            'is_hospital_clinic' => 1,
        ];

        $response = $this->postJson('/api/customers/save', $payload);

        // Should return 500 status from catch block
        $response->assertStatus(500);

        // Verify Rollback: Database me koi customer insert nahi hona chahiye
        $this->assertDatabaseMissing('customers', [
            'email' => secure('invalid@example.com', 'E'), 
        ]);

        // Ensure Job WAS NOT dispatched
        Queue::assertNotPushed(SendWelcomeEmailJob::class);
    }
}