<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeechNameSeeder extends Seeder
{

    private $tableName = 'speech_names';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $speechNamesSeeder = [
            // vi-VN
            [
                'id'            => 1,
                'voice_code'    => 'vi-VN-Binh',
                'speech_name'   => 'Binh (Male)',
                'language_code' => 'vi-VN',
            ],
            [
                'id'            => 2,
                'voice_code'    => 'vi-VN-Hyunh',
                'speech_name'   => 'Hyunh (Female)',
                'language_code' => 'vi-VN',
            ],
            [
                'id'            => 3,
                'voice_code'    => 'vi-VN-Thi',
                'speech_name'   => 'Thi (Female)',
                'language_code' => 'vi-VN',
            ],
            [
                'id'            => 4,
                'voice_code'    => 'vi-VN-Xuan',
                'speech_name'   => 'Xuan (Male)',
                'language_code' => 'vi-VN',
            ],
            [
                'id'            => 5,
                'voice_code'    => 'vi-VN-An',
                'speech_name'   => 'An (Male)',
                'language_code' => 'vi-VN',
            ],


            // en-US
            [
                'id'            => 6,
                'voice_code'    => 'en-US-Ivy',
                'speech_name'   => 'Ivy (Female Child)',
                'language_code' => 'en-US',
            ],
            [
                'id'            => 7,
                'voice_code'    => 'en-US-Joanna',
                'speech_name'   => 'Joanna (Female)',
                'language_code' => 'en-US',
            ],
            [
                'id'            => 8,
                'voice_code'    => 'en-US-Joey',
                'speech_name'   => 'Joey (Male)',
                'language_code' => 'en-US',
            ],
            [
                'id'            => 9,
                'voice_code'    => 'en-US-Kendra',
                'speech_name'   => 'Kendra (Female)',
                'language_code' => 'en-US',
            ],
            [
                'id'            => 10,
                'voice_code'    => 'en-US-Kimberly',
                'speech_name'   => 'Kimberly (Female)',
                'language_code' => 'en-US',
            ],
            [
                'id'            => 11,
                'voice_code'    => 'en-US-Matthew',
                'speech_name'   => 'Matthew (Male)',
                'language_code' => 'en-US',
            ],

            // id-ID
            [
                'id'            => 12,
                'voice_code'    => 'id-ID-Anastasia',
                'speech_name'   => 'Anastasia (Female)',
                'language_code' => 'id-ID',
            ],
            [
                'id'            => 13,
                'voice_code'    => 'id-ID-David',
                'speech_name'   => 'David (Male)',
                'language_code' => 'id-ID',
            ],
            [
                'id'            => 14,
                'voice_code'    => 'Henry',
                'speech_name'   => 'Henry (Male)',
                'language_code' => 'id-ID',
            ],
            [
                'id'            => 15,
                'voice_code'    => 'id-ID-Putri',
                'speech_name'   => 'Putri (Female)',
                'language_code' => 'id-ID',
            ],
            [
                'id'            => 16,
                'voice_code'    => 'id-ID-Andika',
                'speech_name'   => 'Andika (Male)',
                'language_code' => 'id-ID',
            ],
        ];

        DB::table($this->tableName)->delete();
        DB::table($this->tableName)->insert($speechNamesSeeder);
    }
}
