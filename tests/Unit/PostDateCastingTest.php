<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class PostDateCastingTest extends TestCase
{
    public function test_published_at_is_cast_to_a_date(): void
    {
        $post = new Post([
            'published_at' => '2026-10-11 12:00:00',
        ]);

        $this->assertInstanceOf(Carbon::class, $post->published_at);
        $this->assertSame('October 11, 2026', $post->published_at->format('F d, Y'));
    }
}
