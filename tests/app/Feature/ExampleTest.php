<?php

namespace Tests\App\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test */
    public function example_create_works()
    {
        $title = 'this is the title';
        $description = 'description on the body';

        $response = $this->postJson('/api/example', [
            'title' => $title,
            'description' => $description
        ]);

        dd($response->content());

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'title' => $title,
            'description' => $description,
            'success' => true
        ]);

        $content = json_decode($response->content(), true);
        $this->assertEquals($title, $content['data']['title']);
        $this->assertEquals($description, $content['data']['description']);
        $this->assertEquals(now(), $content['data']['created_at'], '', 1);
    }
}
