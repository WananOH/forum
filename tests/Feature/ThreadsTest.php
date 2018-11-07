<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = factory('App\Models\Thread')->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->get('/threads')
            ->assertStatus(200);
    }

    public function test_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    public function test_user_can_read_single_thread()
    {
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    public function test_user_can_read_replies_with_thread(){
        $reply = factory('App\Models\Reply')->create(['thread_id'=> $this->thread->id]);

        $this->get('/threads/'.$this->thread->id)
            ->assertSee($reply->body);
    }

}

