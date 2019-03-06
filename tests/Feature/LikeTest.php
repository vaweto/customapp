<?php

namespace Tests\Feature;

use Tests\TestCase;
Use App\Post;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class LikeTest extends TestCase
{

    /** @test */
    public function a_user_can_like_a_post()
    {
        $post = factory(Post::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->like();

        $this->assertDatabaseHas('likes',[
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertTrue($post->isLiked());
    }

    /** @test */
    function a_user_can_unlike_a_post()
    {
        // having a post
        $post = factory(Post::class)->create();
        // having a user
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->like();

        // unlike a post
        $post->unlike();
        //assert this user has unlike th post

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertFalse($post->isLiked());


    }

    /** @test */
    public function a_user_may_toggle_a_posts_like_status()
    {
        // having a post
        $post = factory(Post::class)->create();
        // having a user
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->toggle();

        $this->assertTrue($post->isLiked());

        $post->toggle();

        $this->assertFalse($post->isLiked());
    }

    /** @test */
    public function a_post_knows_how_many_likes_it_has()
    {
        // having a post
        $post = factory(Post::class)->create();
        // having a user
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->toggle();

        $this->assertEquals(1,$post->likesCount);
    }
}