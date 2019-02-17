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
        $msg = factory(App\Message::class, 20)->create();
        $usr = factory(App\User::class, 4)->create();

    }
}
