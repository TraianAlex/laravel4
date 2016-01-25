<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Phone;
use App\Post;
use App\Comment;
use App\Country;
use App\Video;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //User::truncate();
        //Post::truncate();

        //factory(User::class, 10)->create();
        //factory(Phone::class, 20)->create();
        //factory(Post::class, 10)->create();
        //factory(Comment::class, 10)->create();
        //factory(Country::class, 10)->create();
        //factory(Video::class, 10)->create();
        Model::reguard();
    }
}