<?php

namespace Tests\Unit;

use App\Book;
use App\Reservation;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_can_be_checked_out()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $book->checkOut($user);

        $this->assertCount(1, Reservation::all());
        $this->assertEquals($user->id, Reservation::first()->user_id);
        $this->assertEquals($book->id, Reservation::first()->book_id);
        $this->assertEquals(now(), Reservation::first()->checked_out_at);

    }

    public function test_a_can_be_returned()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();
        $book->checkOut($user);

        $book->checkIn($user);

        $this->assertCount(1, Reservation::all());
        $this->assertEquals($user->id, Reservation::first()->user_id);
        $this->assertEquals($book->id, Reservation::first()->book_id);
        $this->assertNotNull( Reservation::first()->checked_in_at);
        $this->assertEquals(now(), Reservation::first()->checked_in_at);

    }

    public function test_not_checked_out_exception_is_thrown()
    {
        $this->expectException(\Exception::Class);
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();
        $book->checkIn($user);

    }
}
