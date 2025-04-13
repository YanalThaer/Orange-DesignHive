<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Profile;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use Dom\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            CommentSeeder::class,
            LikeSeeder::class,
            MessageSeeder::class,
            PaymentSeeder::class,
            ProjectSeeder::class,
            ProfileSeeder::class,
            SubscriptionSeeder::class,
            // SubscriptionPlansSeeder::class,
            UserSeeder::class,
            ProjectImageSeeder::class,
            TagSeeder::class,
            ProjectTagsSeeder::class,
        ]);
    }
}
