<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Article;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
   /** @test */
   function it_fetches_trending_articles()
   {
       // Given
        factory(Article::class, 3)->create();

        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

       // When
       $articles = Article::trending();

       // Then
       $this->assertEquals($mostPopular->id, $articles->first()->id);

       $this->assertCount(3,$articles);
   }
}
