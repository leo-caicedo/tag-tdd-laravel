<?php

namespace Tests\Feature\Htpp\Controllers;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
      //$this->withoutExceptionHandling();
      $this
	->post('tags', ['name' => 'Backend'])
	->assertRedirect('/');
      
      $this->assertDatabaseHas('tags', 	['name' => 'Backend']);
    }

    public function test_destroy()
    {
      $tag = Tag::factory()->create();
      
      $this
	->delete("tags/$tag->id")
	->assertRedirect('/');

      $this->assertDatabaseMissing('tags', ['name' => $tag->name]);
    }

    public function test_validate()
    {
      $this
	->post('tags', ['name' => ''])
      	->assertSessionHasErrors('name');
    }
}
