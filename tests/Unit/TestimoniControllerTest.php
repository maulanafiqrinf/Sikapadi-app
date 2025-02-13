<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Testimoni;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class TestimoniControllerTest extends TestCase
{
    use RefreshDatabase;

    // Test Case untuk index method
    public function test_index_method_returns_view_with_testimonis()
    {
        // Arrange
        $testimonis = Testimoni::factory()->count(3)->create();

        // Act
        $response = $this->get(route('testimoni.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('backoffice.testimoni.app');
        $response->assertViewHas('testimonis', $testimonis);
    }

    // Test Case untuk create method
    public function test_create_method_returns_view()
    {
        // Act
        $response = $this->get(route('testimoni.create'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('backoffice.testimoni.create');
        $response->assertViewHas('title', 'Tambah Testimoni');
    }

    // Test Case untuk store method
    public function test_store_method_creates_new_testimoni()
    {
        // Arrange
        $data = [
            'title' => 'Test Testimoni',
            'content' => 'This is a test content.',
            'status' => 'published',
        ];

        // Act
        $response = $this->post(route('testimoni.store'), $data);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Data berhasil disimpan.'
        ]);
        $this->assertDatabaseHas('testimonis', $data);
    }

    // Test Case untuk edit method
    public function test_edit_method_returns_view_with_testimoni()
    {
        // Arrange
        $testimoni = Testimoni::factory()->create();

        // Act
        $response = $this->get(route('testimoni.edit', $testimoni->id));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('backoffice.testimoni.edit');
        $response->assertViewHas('testimonis', $testimoni);
    }

    // Test Case untuk update method
    public function test_update_method_updates_testimoni()
    {
        // Arrange
        $testimoni = Testimoni::factory()->create();
        $data = [
            'title' => 'Updated Testimoni',
            'content' => 'Updated content.',
            'status' => 'draft',
        ];

        // Act
        $response = $this->put(route('testimoni.update', $testimoni->id), $data);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Data berhasil diupdate.'
        ]);
        $this->assertDatabaseHas('testimonis', $data);
    }

    // Test Case untuk destroy method
    public function test_destroy_method_deletes_testimoni()
    {
        // Arrange
        $testimoni = Testimoni::factory()->create();

        // Act
        $response = $this->delete(route('testimoni.destroy', $testimoni->id));

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
        $this->assertDatabaseMissing('testimonis', ['id' => $testimoni->id]);
    }

    // Test Case untuk validasi store method
    public function test_store_method_validates_request()
    {
        // Arrange
        $data = [
            'title' => '',
            'content' => 'This is a test content.',
            'status' => 'invalid_status',
        ];

        // Act
        $response = $this->post(route('testimoni.store'), $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'status']);
    }

    // Test Case untuk validasi update method
    public function test_update_method_validates_request()
    {
        // Arrange
        $testimoni = Testimoni::factory()->create();
        $data = [
            'title' => '',
            'content' => 'Updated content.',
            'status' => 'invalid_status',
        ];

        // Act
        $response = $this->put(route('testimoni.update', $testimoni->id), $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'status']);
    }

    // Test Case untuk store method dengan exception
    public function test_store_method_handles_exception()
    {
        // Arrange
        Mockery::mock(Testimoni::class, function ($mock) {
            $mock->shouldReceive('create')->andThrow(new \Exception('Test Exception'));
        });

        $data = [
            'title' => 'Test Testimoni',
            'content' => 'This is a test content.',
            'status' => 'published',
        ];

        // Act
        $response = $this->post(route('testimoni.store'), $data);

        // Assert
        $response->assertStatus(500);
        $response->assertJson([
            'success' => false,
            'message' => 'Test Exception'
        ]);
    }

    // Test Case untuk update method dengan exception
    public function test_update_method_handles_exception()
    {
        // Arrange
        $testimoni = Testimoni::factory()->create();
        Mockery::mock(Testimoni::class, function ($mock) {
            $mock->shouldReceive('findOrFail')->andThrow(new \Exception('Test Exception'));
        });

        $data = [
            'title' => 'Updated Testimoni',
            'content' => 'Updated content.',
            'status' => 'draft',
        ];

        // Act
        $response = $this->put(route('testimoni.update', $testimoni->id), $data);

        // Assert
        $response->assertStatus(500);
        $response->assertJson([
            'success' => false,
            'message' => 'Test Exception'
        ]);
    }

    // Test Case untuk destroy method dengan exception
    public function test_destroy_method_handles_exception()
    {
        // Arrange
        $testimoni = Testimoni::factory()->create();
        Mockery::mock(Testimoni::class, function ($mock) {
            $mock->shouldReceive('findOrFail')->andThrow(new \Exception('Test Exception'));
        });

        // Act
        $response = $this->delete(route('testimoni.destroy', $testimoni->id));

        // Assert
        $response->assertStatus(500);
        $response->assertJson([
            'success' => false,
            'message' => 'Test Exception'
        ]);
    }
}
