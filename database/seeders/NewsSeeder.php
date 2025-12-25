<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsItems = [
            [
                'user_id' => 1,
                'title' => 'New Sci-Fi Epic Breaks Box Office Records on Opening Weekend',
                'content' => 'The highly anticipated sci-fi film has shattered box office expectations, drawing massive global audiences and receiving widespread acclaim for its visual effects.',
                'image' => 'news/sci-fi-epic.png',
                'publication_date' => '2025-01-05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Beloved Director Announces Sequel to Cult Classic',
                'content' => 'Fans are thrilled as the director officially confirmed that a sequel to the cult classic is in development, promising a deeper story and returning cast members.',
                'image' => 'news/cult-classic.png',
                'publication_date' => '2025-01-12',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Animated Adventure Becomes Surprise Awards Contender',
                'content' => 'An animated feature that flew under the radar has now become one of the top contenders for multiple award categories, praised for its heartfelt story.',
                'image' => 'news/animated-adventure.png',
                'publication_date' => '2025-01-20',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Action Star Makes Stunning Return After Five-Year Break',
                'content' => 'The actor’s new action thriller is already generating buzz, marking a powerful comeback after years away from the spotlight.',
                'image' => 'news/action-star.png',
                'publication_date' => '2025-02-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Indie Drama Receives Standing Ovation at Film Festival',
                'content' => 'Critics praised the film for its intimate storytelling and strong performances during its premiere at the international film festival.',
                'image' => 'news/indie-drama.png',
                'publication_date' => '2025-02-08',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Classic Horror Franchise Reveals Reboot Trailer',
                'content' => 'The newly released trailer for the reboot of the iconic horror franchise has generated excitement among longtime fans and newcomers alike.',
                'image' => 'news/horror-reboot.png',
                'publication_date' => '2025-02-14',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Romantic Comedy Tops Streaming Charts Worldwide',
                'content' => 'A light-hearted romantic comedy has unexpectedly taken over global streaming rankings, praised for its charm and relatable humor.',
                'image' => 'news/romcom.png',
                'publication_date' => '2025-02-18',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Historical Epic Set to Become the Most Expensive Film Ever Made',
                'content' => 'Reports indicate that the upcoming historical epic boasts an unprecedented production budget, featuring enormous sets and a massive international cast.',
                'image' => 'news/historical-epic.png',
                'publication_date' => '2025-02-25',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Director Teases New Mystery Thriller With Cryptic Poster',
                'content' => 'A mysterious teaser poster has sparked online speculation, hinting at the director’s return to the thriller genre.',
                'image' => 'news/mystery-thriller.png',
                'publication_date' => '2025-03-03',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Fantasy Franchise Announces Casting for Lead Role',
                'content' => 'Producers revealed the new lead actor for the beloved fantasy franchise, generating excitement across social media.',
                'image' => 'news/fantasy-franchise.png',
                'publication_date' => '2025-03-10',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($newsItems as $newsItem) {
            DB::table('news')->updateOrInsert(
                ['title' => $newsItem['title']],
                $newsItem
            );
        }
    }
}
