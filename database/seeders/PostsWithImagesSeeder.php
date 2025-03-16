<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class PostsWithImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure the storage directory exists
        if (!File::exists(storage_path('app/public/images'))) {
            File::makeDirectory(storage_path('app/public/images'), 0755, true);
        }

        $faker = Faker::create();
        $users = User::all();

        // If no users exist, create one
        if ($users->isEmpty()) {
            $users = User::factory(1)->create();
        }

        // Sample image URLs to download
        $imageUrls = [
            'https://picsum.photos/800/600?random=1',
            'https://picsum.photos/800/600?random=2',
            'https://picsum.photos/800/600?random=3',
            'https://picsum.photos/800/600?random=4',
            'https://picsum.photos/800/600?random=5',
        ];

        // Create 10 posts with images
        for ($i = 0; $i < 10; $i++) {
            // Download a random image
            $imageUrl = $imageUrls[array_rand($imageUrls)];
            $imageContent = file_get_contents($imageUrl);
            $imageName = 'seed_' . time() . '_' . $i . '.jpg';
            Storage::put('public/images/' . $imageName, $imageContent);

            // Create post with the image
            Post::create([
                'title' => $faker->sentence(6),
                'description' => $faker->paragraphs(3, true),
                'user_id' => $users->random()->id,
                'image' => $imageName,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);

            // Add a small delay to ensure unique timestamps for image names
            sleep(1);
        }
    }
}
