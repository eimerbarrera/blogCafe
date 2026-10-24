<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTaxonomyLinksTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_links_post_categories_and_tags_to_their_filters(): void
    {
        $post = Post::create([
            'user_id' => User::factory()->create()->id,
            'title' => 'Café de origen',
            'content' => 'Contenido del artículo.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $categories = collect([
            Category::create(['name' => 'Cultivo', 'slug' => 'cultivo']),
            Category::create(['name' => 'Preparación', 'slug' => 'preparacion']),
        ]);
        $tag = Tag::create(['name' => 'Arábica', 'slug' => 'arabica']);

        $post->categories()->attach($categories->pluck('id'));
        $post->tags()->attach($tag->id);

        $response = $this->get('/');

        $response->assertOk();
        foreach ($categories as $category) {
            $response->assertSee(route('blog.category', $category->slug), false);
        }
        $response->assertSee(route('blog.tag', $tag->slug), false);
    }
}
