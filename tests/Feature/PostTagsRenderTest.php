<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTagsRenderTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_post_tags_are_shown_in_the_footer_and_sidebar(): void
    {
        $post = Post::create([
            'user_id' => User::factory()->create()->id,
            'title' => 'Café de origen',
            'content' => 'Contenido del artículo.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $tags = collect([
            ['name' => 'Grano de origen', 'slug' => 'grano-de-origen'],
            ['name' => 'Tueste medio', 'slug' => 'tueste-medio'],
            ['name' => 'Extracción lenta', 'slug' => 'extraccion-lenta'],
        ])->map(fn (array $attributes) => Tag::create($attributes));

        $post->tags()->attach($tags->pluck('id')->all());

        $response = $this->get(route('blog.show', [
            'id' => $post->id,
            'slug' => $post->slug,
        ]));

        $response->assertOk();

        foreach ($tags as $tag) {
            self::assertSame(2, substr_count($response->getContent(), $tag->name));
            $response->assertSee(route('blog.tag', $tag->slug), false);
        }
    }

    public function test_all_tags_are_shown_for_each_post_on_the_home_page(): void
    {
        $user = User::factory()->create();
        $firstPost = Post::create([
            'user_id' => $user->id,
            'title' => 'Métodos de preparación',
            'content' => 'Contenido del primer artículo.',
            'status' => 'published',
            'published_at' => now(),
        ]);
        $secondPost = Post::create([
            'user_id' => $user->id,
            'title' => 'Cultivo de café',
            'content' => 'Contenido del segundo artículo.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $firstPostTags = collect([
            ['name' => 'Prensa francesa', 'slug' => 'prensa-francesa'],
            ['name' => 'Métodos filtrados', 'slug' => 'metodos-filtrados'],
        ])->map(fn (array $attributes) => Tag::create($attributes));
        $secondPostTags = collect([
            ['name' => 'Café de altura', 'slug' => 'cafe-de-altura'],
            ['name' => 'Cosecha', 'slug' => 'cosecha'],
        ])->map(fn (array $attributes) => Tag::create($attributes));

        $firstPost->tags()->attach($firstPostTags->pluck('id')->all());
        $secondPost->tags()->attach($secondPostTags->pluck('id')->all());

        $response = $this->get('/');

        $response->assertOk();

        foreach ($firstPostTags->concat($secondPostTags) as $tag) {
            self::assertSame(1, substr_count($response->getContent(), $tag->name));
        }
    }
}
