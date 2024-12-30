<?php

namespace Tests\Feature\Http\Requests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreRecipeRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test validation passes with valid data.
     */
    public function test_it_passes_validation_with_valid_data()
    {
        $data = [
            'title' => 'Delicious Recipe',
            'description' => 'A very delicious recipe',
            'prep_time' => 10,
            'cook_time' => 20,
            'total_time' => 30,
            'servings' => 4,
        ];

        $response = $this->postJson('/api/recipes', $data);

        $response->assertStatus(201)
                ->assertJsonFragment($data);
    }

    /**
     * Test validation fails with missing required fields.
     */
    public function test_it_fails_validation_with_missing_fields()
    {
        $data = [
            'title' => '', // Required field
            'prep_time' => '', // Required field
            'cook_time' => '', // Required field
            'total_time' => '', // Required field
            'servings' => '', // Required field
        ];

        $response = $this->postJson('/api/recipes', $data);

        $response->assertStatus(422) // Validation failed
                 ->assertJsonValidationErrors([
                     'title',
                     'prep_time',
                     'cook_time',
                     'total_time',
                     'servings',
                 ]);
    }

    /**
     * Test validation fails with invalid data types.
     */
    public function test_it_fails_validation_with_invalid_data_types()
    {
        $data = [
            'title' => 12345, // Invalid type
            'prep_time' => 'invalid', // Invalid type
            'cook_time' => 'invalid', // Invalid type
            'total_time' => 'invalid', // Invalid type
            'servings' => 'invalid', // Invalid type
        ];

        $response = $this->postJson('/api/recipes', $data);

        $response->assertStatus(422) // Validation failed
                 ->assertJsonValidationErrors([
                     'title',
                     'prep_time',
                     'cook_time',
                     'total_time',
                     'servings',
                 ]);
    }

    /**
     * Test validation fails when numeric fields are below the minimum value.
     */
    public function test_it_fails_validation_with_numeric_fields_below_minimum()
    {
        $data = [
            'title' => 'Test Recipe',
            'prep_time' => 0, // Minimum is 1
            'cook_time' => 0, // Minimum is 1
            'total_time' => 0, // Minimum is 1
            'servings' => 0, // Minimum is 1
        ];

        $response = $this->postJson('/api/recipes', $data);

        $response->assertStatus(422) // Validation failed
                 ->assertJsonValidationErrors([
                     'prep_time',
                     'cook_time',
                     'total_time',
                     'servings',
                 ]);
    }
}
