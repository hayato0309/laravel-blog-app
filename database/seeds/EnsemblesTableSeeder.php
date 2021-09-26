<?php

use Illuminate\Database\Seeder;

class EnsemblesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Ensembles')->insert(
            [
                [
                    'user_id' => 1,
                    'headline' => "Let's play Beethoven Symphony No.3 together! (String orchestra version)",
                    'introduction' => "I'm looking for string players who can play Beethoven symphony no.3 together.",
                    'piece' => 'Symphony No.3 1st movement',
                    'Composer' => 'Beethoven',
                    'music_sheet' => 'https://imslp.org/wiki/Symphony_No.3%2C_Op.55_(Beethoven%2C_Ludwig_van)',
                    'violin' => 4,
                    'viola' => 2,
                    'cello' => 2,
                    'contrabass' => 2,
                    'flute' => null,
                    'oboe' => null,
                    'clarinet' => null,
                    'bassoon' => null,
                    'saxophone' => null,
                    'trumpet' => null,
                    'horn' => null,
                    'trombone' => null,
                    'tuba' => null,
                    'piano' => null,
                    'harp' => null,
                    'timpani' => null,
                    'snare_drum' => null,
                    'bass_drum' => null,
                    'tambourine' => null,
                    'triangle' => null,
                    'deadline' => date('Y-m-d H:i:s', strtotime(now()  . ' + months')),
                    'notes' => 'This is only for advanced level string players who has 10 years experience at least.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 2,
                    'headline' => "Mendelssohn String Octet",
                    'introduction' => "This is my dream piece. I'm welcoming intermediate to advanced players.",
                    'piece' => 'Octet 1st movement',
                    'Composer' => 'Mendelssohn',
                    'music_sheet' => 'https://imslp.org/wiki/String_Octet,_Op.20_(Mendelssohn,_Felix)',
                    'violin' => 3,
                    'viola' => 2,
                    'cello' => 2,
                    'contrabass' => null,
                    'flute' => null,
                    'oboe' => null,
                    'clarinet' => null,
                    'bassoon' => null,
                    'saxophone' => null,
                    'trumpet' => null,
                    'horn' => null,
                    'trombone' => null,
                    'tuba' => null,
                    'piano' => null,
                    'harp' => null,
                    'timpani' => null,
                    'snare_drum' => null,
                    'bass_drum' => null,
                    'tambourine' => null,
                    'triangle' => null,
                    'deadline' => date('Y-m-d H:i:s', strtotime(now()  . ' + months')),
                    'notes' => 'We will use the 2nd score in the url above.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => 3,
                    'headline' => "My first ensemble experience with Canon in D!",
                    'introduction' => "I'm looking for string players who can play Canon in D with me.",
                    'piece' => 'Canon in D',
                    'Composer' => 'Pachelbel',
                    'music_sheet' => 'https://imslp.org/wiki/Canon_and_Gigue_in_D_major%2C_P.37_(Pachelbel%2C_Johann)',
                    'violin' => 1,
                    'viola' => 1,
                    'cello' => 1,
                    'contrabass' => null,
                    'flute' => null,
                    'oboe' => null,
                    'clarinet' => null,
                    'bassoon' => null,
                    'saxophone' => null,
                    'trumpet' => null,
                    'horn' => null,
                    'trombone' => null,
                    'tuba' => null,
                    'piano' => null,
                    'harp' => null,
                    'timpani' => null,
                    'snare_drum' => null,
                    'bass_drum' => null,
                    'tambourine' => null,
                    'triangle' => null,
                    'deadline' => date('Y-m-d H:i:s', strtotime(now()  . ' + months')),
                    'notes' => "I'm a violin player so I only need another player for violin section.",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ]
        );
    }
}
