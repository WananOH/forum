<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
//    public function test_unauthenticated_user_may_no_add_replies()
//    {
//        $this->expectException('Illuminate\Auth\AuthenticationException');
//
//        $thread = factory('App\Models\Thread')->create();
//
//        $reply = factory('App\Modles\Reply')->create();
//        $this->post($thread->path().'/replies',$reply->toArray());
//    }

    function test_authenticated_user_may_participate_in_forum_threads()
    {
        // Given we have a authenticated user
        $this->be($user = factory('App\User')->create());

        // And an existing thread
        $thread = factory('App\Models\Thread')->create();

        // When the user adds a reply to the thread
        $reply = factory('App\Models\Reply')->make();
        $this->post($thread->path().'/replies',$reply->toArray());

        // Then their reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }


}
