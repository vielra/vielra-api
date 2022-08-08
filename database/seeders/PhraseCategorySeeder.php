<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PhraseCategorySeeder extends Seeder
{

    private $tableName = 'phrase_categories';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->tableName)->delete();
        $categories = array(
            array(
                'id'        => '96f09261-aceb-4b85-bb28-821d8c8a04fa',
                'slug'      => 'uncategory',
                'name'      => json_encode([
                    "en"    => "Uncategory",
                    "id"    => "Tidak Berkategori",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0a7c2-18a1-46ff-954b-0c233d2cc85e',
                'slug'      => 'general',
                'name'      => json_encode([
                    "en"    => "General",
                    "id"    => "Umum",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0a837-4328-4113-9895-db02b4097e42',
                'slug'      => 'greeting',
                'name'      => json_encode([
                    "en"    => "Greeting",
                    "id"    => "Salam",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0a915-b7ec-44dc-8f7c-c7e190365981',
                'slug'      => 'romance',
                'name'      => json_encode([
                    "en"    => "Romance",
                    "id"    => "Asmara",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0a94e-c8b7-40c9-bdff-501ffe9aac28',
                'slug'      => 'emergency',
                'name'      => json_encode([
                    "en"    => "Emergency",
                    "id"    => "Darurat",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0a9ad-6324-406b-b823-7f6bfbcfd1d7',
                'slug'      => 'eat',
                'name'      => json_encode([
                    "en"    => "Eat",
                    "id"    => "Makan",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0a9c6-d4e6-4553-8a41-961094bdd937',
                'slug'      => 'shopping',
                'name'      => json_encode([
                    "en"    => "Shopping",
                    "id"    => "Belanja",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0aa09-3f33-41c6-aa0a-398a06929401',
                'slug'      => 'number',
                'name'      => json_encode([
                    "en"    => "Numbers",
                    "id"    => "Angka",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0aa66-13b2-40ad-b809-60ed951d5aa2',
                'slug'      => 'transportations',
                'name'      => json_encode([
                    "en"    => "Transportations",
                    "id"    => "Transportasi",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0aae8-eb3a-4138-9d83-6fb61e412b70',
                'slug'      => 'accommodations',
                'name'      => json_encode([
                    "en"    => "Accommodations",
                    "id"    => "Akomodasi",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0ab58-deb3-4afd-8fbf-c2c533cbbccf',
                'slug'      => 'directions',
                'name'      => json_encode([
                    "en"    => "Directions",
                    "id"    => "Petunjuk Arah",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0aba1-dc45-4914-af6e-9f6f7082b12e',
                'slug'      => 'weather',
                'name'      => json_encode([
                    "en"    => "Weather",
                    "id"    => "Cuaca",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0abf3-1811-47f9-bff2-ee3714a36e4a',
                'slug'      => 'driving',
                'name'      => json_encode([
                    "en"    => "Driving",
                    "id"    => "Berkendara",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0ac31-d710-48cd-80a5-25daeb27f61e',
                'slug'      => 'places',
                'name'      => json_encode([
                    "en"    => "Places",
                    "id"    => "Tempat",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f0ac94-dfb1-418a-a42c-353c479d712a',
                'slug'      => 'sightseeing',
                'name'      => json_encode([
                    "en"    => "Sightseeing",
                    "id"    => "Tamasya",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f14ded-f214-42b4-be78-60d5f67444aa',
                'slug'      => 'animal',
                'name'      => json_encode([
                    "en"    => "Animal",
                    "id"    => "Hewan",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f14ded-f214-42b4-be78-60d5f67445ba',
                'slug'      => 'fruits',
                'name'      => json_encode([
                    "en"    => "Fruits",
                    "id"    => "Buah-buahan",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f14e31-b302-4db5-9f4c-038bad211493',
                'slug'      => 'date-time',
                'name'      => json_encode([
                    "en"    => "Date & Time",
                    "id"    => "Tanggal & Waktu",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f14e83-61b9-4047-b197-194cc8e394ff',
                'slug'      => 'colors',
                'name'      => json_encode([
                    "en"    => "Colors",
                    "id"    => "Warna",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f14eb3-e35a-4511-9824-4c6ccb499276',
                'slug'      => 'lesson',
                'name'      => json_encode([
                    "en"    => "Lesson",
                    "id"    => "Pelajaran",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f14ef1-55a5-41a7-b03d-49c301c2627a',
                'slug'      => 'works',
                'name'      => json_encode([
                    "en"    => "Works",
                    "id"    => "Pekerjaan",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f14f9e-8370-4db8-bc14-9feb9b7e59db',
                'slug'      => 'hobby',
                'name'      => json_encode([
                    "en"    => "Hobby",
                    "id"    => "Hobi",
                    "vi"    => null
                ])
            ),
            array(
                'id'        => '96f150cb-a05f-4a67-bf33-bb6c8b7c77ce',
                'slug'      => 'others',
                'name'      => json_encode([
                    "en"    => "Others",
                    "id"    => "Lain-lain",
                    "vi"    => null
                ])
            ),

        );
        DB::table($this->tableName)->insert($categories);
    }
}
