<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Blog;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_all_blogs()
    {
        Blog::factory()->count(3)->create();

        $response = $this->get(route('blogs.index'));

        $response->assertStatus(200);
        $response->assertViewIs('backoffice.blog.app');
        $response->assertViewHas('blogs');
    }

    /** @test */
    public function it_can_store_a_blog()
    {
        $data = [
            'title' => 'Test Blog',
            'content' => 'Test content',
            'image' => 'test.jpg',
            'status' => 'draft'
        ];

        $response = $this->postJson(route('blogs.store'), $data);

        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Data berhasil disimpan.']);

        $this->assertDatabaseHas('blogs', $data);
    }

    /** @test */
    public function it_can_update_a_blog()
    {
        $blog = Blog::factory()->create();

        $updateData = ['title' => 'Updated Title', 'content' => 'Updated Content', 'status' => 'published'];

        $response = $this->putJson(route('blogs.update', $blog->id), $updateData);

        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Data berhasil diupdate.']);

        $this->assertDatabaseHas('blogs', $updateData);
    }

    /** @test */
    public function it_can_delete_a_blog()
    {
        $blog = Blog::factory()->create();

        $response = $this->deleteJson(route('blogs.destroy', $blog->id));

        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Data berhasil dihapus.']);

        $this->assertDatabaseMissing('blogs', ['id' => $blog->id]);
    }
}
