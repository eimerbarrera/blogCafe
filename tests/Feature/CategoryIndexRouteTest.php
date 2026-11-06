<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('renders category management for administrators and editors', function (string $role) {
    $category = Category::create([
        'name' => 'Cultivo',
        'slug' => 'cultivo',
    ]);
    $user = User::factory()->create(['role' => $role]);

    $response = $this->actingAs($user)->get(route('categories.index'));

    $response->assertOk()
        ->assertSee('Gestión de Categorías')
        ->assertSee($category->name)
        ->assertSee($category->slug);
})->with(['admin', 'editor']);

it('forbids users without category management privileges', function () {
    $user = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($user)->get(route('categories.index'));

    $response->assertForbidden();
});
