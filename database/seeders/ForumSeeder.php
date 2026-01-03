<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure Tags exist
        if (Tag::count() === 0) {
            $this->call(TagSeeder::class);
        }
        $tags = Tag::all();

        // 2. Create regular Users
        $users = User::factory()->count(10)->create();

        // 3. Create Topics for each user
        $users->each(function ($user) use ($tags) {
            $topics = Topic::factory()->count(rand(2, 4))->create([
                'user_id' => $user->id,
            ]);

            $topics->each(function ($topic) use ($tags) {
                // Attach random tags
                $topic->tags()->attach(
                    $tags->random(rand(1, 3))->pluck('id')->toArray()
                );

                // 4. Create Posts (replies) for each topic
                Post::factory()->count(rand(2, 5))->create([
                    'topic_id' => $topic->id,
                    'user_id' => User::all()->random()->id,
                ]);
            });
        });
    }
}
