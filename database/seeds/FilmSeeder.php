<?php

use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 1)->create();
        $films = factory(App\Film::class, 3)->create();

        foreach ($films as $film) {
            $comment = new \App\Comment();
            $comment->fill([
                'user_id' => $users[0]->id,
                'film_id' => $film->id,
                'subject' => 'Subject',
                'body' => 'Body'
            ]);
            $comment->save();
        }
    }
}
