<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         factory(App\User::class, 4)->create();
         factory(App\Message::class, 20)->create()->each(function($m) {
            $m->replies()->saveMany(factory(App\Reply::class, rand(0,2))->make()
              );
         });
       
    }
}
