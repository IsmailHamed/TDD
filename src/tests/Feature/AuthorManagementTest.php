<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_author_can_be_create()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/author', [
            'name' => 'Author Name',
            'dob' => '01/01/2020'
        ]);
        $response->assertOk();
        $author = Author::all();
        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('2020/01/01', $author->first()->dob->format('Y/d/m'));

    }
}
