<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear 5 Usuarios (1 Admin + 4 Autores/Lectores)
        $admin = User::create([
            'name' => 'Carlos Barista',
            'email' => 'admin@granoagrano.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $editor1 = User::create([
            'name' => 'Luisa Tostadora',
            'email' => 'editor1@granoagrano.com',
            'password' => Hash::make('password123'),
            'role' => 'editor',
        ]);

        $editor2 = User::create([
            'name' => 'Andrés Barista',
            'email' => 'editor2@granoagrano.com',
            'password' => Hash::make('password123'),
            'role' => 'editor',
        ]);

        $user1 = User::create([
            'name' => 'Sofía Amante del Café',
            'email' => 'user1@granoagrano.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Mateo Cafetero',
            'email' => 'user2@granoagrano.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $allUsers = collect([$admin, $editor1, $editor2, $user1, $user2]);

        // 2. Crear 5 Categorías de Café
        $categoriesData = [
            ['name' => 'Cultivo y Cosecha', 'description' => 'Todo sobre la tierra, la semilla y la recolección manual del café colombiano.'],
            ['name' => 'Tueste Artesanal', 'description' => 'El arte de transformar el grano verde en magia aromática.'],
            ['name' => 'Métodos de Extracción', 'description' => 'Guías detalladas para V60, Chemex, Prensa Francesa y Espresso.'],
            ['name' => 'Barismo y Cata', 'description' => 'Notas de cata, puntajes SCAA y técnicas profesionales de servicio.'],
            ['name' => 'Historias de Caficultores', 'description' => 'Rostros, familias y tradiciones detrás de cada taza en nuestras regiones.'],
        ];

        $categories = collect();
        foreach ($categoriesData as $cat) {
            $categories->push(Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]));
        }

        // 3. Crear 5 Tags (Etiquetas)
        $tagsData = ['Arábica', 'Geisha', 'Proceso Honey', 'Origen Huila', 'Café de Especialidad'];
        $tags = collect();
        foreach ($tagsData as $tagName) {
            $tags->push(Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]));
        }

        // 4. Crear 20 Posts con sus detalles, relaciones de categorías, tags y media
        for ($i = 1; $i <= 20; $i++) {
            $title = "Café Grano a Grano: Experiencia y evolución cafetera #{$i}";

            $post = Post::create([
                'user_id' => $allUsers->random()->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'summary' => "Resumen detallado del artículo número {$i} enfocado en la cultura del café colombiano.",
                'content' => "Contenido completo y extendido del post {$i}. Aquí describimos paso a paso el proceso, tips de preparación, recomendaciones de los cafeteros y todo lo necesario para vivir la pasión del café grano a grano en cada etapa.",
                'status' => 'published',
                'featured_image' => 'images/posts/default-coffee.jpg',
                'published_at' => now()->subDays(20 - $i),
            ]);

            // Relacionar cada post con 1 o 2 categorías aleatorias (tabla post_categories)
            $post->categories()->attach(
                $categories->random(rand(1, 2))->pluck('id')->toArray()
            );

            // Relacionar cada post con 2 o 3 etiquetas aleatorias (tabla post_tags)
            $post->tags()->attach(
                $tags->random(rand(2, 3))->pluck('id')->toArray()
            );

            // Crear el registro multimedia asociado al post (tabla media)
            Media::create([
                'post_id' => $post->id,
                'file_path' => 'images/media/coffee-media-' . $i . '.jpg',
                'file_type' => 'image/jpeg',
            ]);
        }
    }
}
