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
                'id'        => '97108888-1409-4acb-88f4-673898f0ec4e',
                'slug'      => 'uncategory',
                'order'     => 0,
                'color'     => '#4B4868',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Uncategory',
                    'id'    => 'Tidak Berkategori',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108892-69dd-4b55-a35f-a28ad3fad8ed',
                'slug'      => 'common',
                'order'     => 1,
                'color'     => '#1F65FF',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Common',
                    'id'    => 'Umum',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108899-4142-46a5-9ff8-f45dc9d1c1f3',
                'slug'      => 'pronouns',
                'order'     => 2,
                'color'     => '#FFB302',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Pronouns',
                    'id'    => 'Sebutan',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971088a5-59bc-4b64-a3ce-d6ed86c786e8',
                'slug'      => 'greeting',
                'order'     => 3,
                'color'     => '#067CFF',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Greeting',
                    'id'    => 'Salam',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971088b5-354d-4b49-9cb6-cb210ecad76a',
                'slug'      => 'basic-conversation',
                'order'     => 4,
                'color'     => '#08BA6C',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Basic Conversation',
                    'id'    => 'Percakapan Umum',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971088c2-2473-4ab3-b7fd-6d5e753e3506',
                'slug'      => 'activity',
                'order'     => 5,
                'color'     => '#B371FF',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'activity',
                    'id'    => 'Aktivitas',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971088d1-0fba-490d-b059-580a432fd518',
                'slug'      => 'body-personality',
                'order'     => 6,
                'color'     => '#00B386',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Body & Personality',
                    'id'    => 'Tubuh & Kepribadian',
                    'vi'    => null
                ])
            ),

            array(
                'id'        => '971088db-f284-43cc-89ac-a96ec2b00464',
                'slug'      => 'family',
                'order'     => 7,
                'color'     => '#B211FF',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Family',
                    'id'    => 'keluarga',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971088e6-b78a-4340-9480-1f75399aa9ef',
                'slug'      => 'dating-romance',
                'order'     => 8,
                'color'     => '#F90074',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Dating & Romance',
                    'id'    => 'Kencan & Asrama',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971088f2-612f-4fcc-80e0-b73bf0172ffb',
                'slug'      => 'music-film',
                'order'     => 9,
                'color'     => '#D84A4A',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Music & Movies',
                    'id'    => 'Musik & Film',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108901-a940-47df-9f19-77a6cf3672c9',
                'slug'      => 'health',
                'order'     => 10,
                'color'     => '#17B427',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Health',
                    'id'    => 'Kesehatan',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '9710890d-074c-47ad-bdcc-64a0784f8b01',
                'slug'      => 'emergency',
                'order'     => 11,
                'color'     => '#FF2222',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Emergency',
                    'id'    => 'Darurat',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108915-755e-470a-8008-0bdabca18293',
                'slug'      => 'eat',
                'order'     => 12,
                'color'     => '#C17D6B',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Eat',
                    'id'    => 'Makan',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108921-b877-4bec-8fcd-609c4f61fcaa',
                'slug'      => 'shopping',
                'order'     => 13,
                'color'     => '#8F9C11',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Shopping',
                    'id'    => 'Belanja',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '9710892d-dead-46c6-938a-50a70fd76b92',
                'slug'      => 'sightseeing',
                'order'     => 14,
                'color'     => '#546C7B',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Sightseeing',
                    'id'    => 'Tamasya',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108948-b1ba-438e-8a0e-62319092681b',
                'slug'      => 'number',
                'order'     => 15,
                'color'     => '#FC493C',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Numbers',
                    'id'    => 'Angka',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108953-64f3-43a7-a87a-a2b50c4b0d2e',
                'slug'      => 'animal',
                'order'     => 16,
                'color'     => '#8f6a3f',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Animal',
                    'id'    => 'Hewan',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108966-c486-4934-9d49-0eb4b583b08f',
                'slug'      => 'flowers',
                'order'     => 17,
                'color'     => '#F568D7',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Flowers',
                    'id'    => 'Bunga',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108971-5d58-49e0-baeb-32770aea7277',
                'slug'      => 'fruit-vegetable',
                'order'     => 18,
                'color'     => '#5CA4FD',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Fruit & Vegetable',
                    'id'    => 'Buah & Sayuran',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '9710897d-adf7-411d-af12-22221596fa0c',
                'slug'      => 'shapes-colors',
                'order'     => 19,
                'color'     => '#f5a300',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Shapes & Colors',
                    'id'    => 'Bentuk & Warna',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108987-419a-44e1-af0b-5093e22b928a',
                'slug'      => 'date-time',
                'order'     => 20,
                'color'     => '#00ba70',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Date & Time',
                    'id'    => 'Tanggal & Waktu',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108996-8f27-497c-a807-d45cfe83972f',
                'slug'      => 'transportations',
                'order'     => 21,
                'color'     => '#ae60e3',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Transportations',
                    'id'    => 'Transportasi',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971089a6-631c-4f01-97c8-608c02d2ad4e',
                'slug'      => 'accommodations',
                'order'     => 22,
                'color'     => '#FF641F',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Accommodations',
                    'id'    => 'Akomodasi',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971089ae-e3d3-4d30-a37f-6737aa8d412e',
                'slug'      => 'directions',
                'order'     => 23,
                'color'     => '#1d4774',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Directions',
                    'id'    => 'Petunjuk Arah',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971089ba-ea93-4faa-8a65-2e92897ce9af',
                'slug'      => 'weather',
                'order'     => 24,
                'color'     => '#902bff',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Weather',
                    'id'    => 'Cuaca',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971089c3-f3f1-4a13-88df-317f83c6aed2',
                'slug'      => 'driving',
                'order'     => 25,
                'color'     => '#24A601',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Driving',
                    'id'    => 'Berkendara',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971089cf-5aba-46e5-a59e-54053a6d9134',
                'slug'      => 'places',
                'order'     => 26,
                'color'     => '#D07B06',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Places',
                    'id'    => 'Tempat',
                    'vi'    => null
                ])
            ),

            array(
                'id'        => '971089d8-34f4-48ab-b77f-d7a3a704f790',
                'slug'      => 'feelings',
                'order'     => 27,
                'color'     => '#32416E',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Feelings',
                    'id'    => 'Perasaan',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971089e0-7a49-44e2-bd78-70b859ebc3d0',
                'slug'      => 'hobbies',
                'order'     => 28,
                'color'     => '#83415D',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Hobbies',
                    'id'    => 'Hobi',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971089eb-9dee-4fc7-9876-327444176379',
                'slug'      => 'question-reasioning',
                'order'     => 29,
                'color'     => '#248f2f',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Question & Reasioning',
                    'id'    => 'Pertanyaan & Pemikiran',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '971089f4-300c-42c3-aeb0-889438718fc2',
                'slug'      => 'airport',
                'order'     => 30,
                'color'     => '#B72A44',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Airport',
                    'id'    => 'Bandara',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108a02-2ad3-4cca-bc55-aaf3d792f0f0',
                'slug'      => 'post-office',
                'order'     => 31,
                'color'     => '#ff773d',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Post Office',
                    'id'    => 'Kantor Pos',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108a0b-5d8f-4432-ac85-3bfe3315daa2',
                'slug'      => 'phone-internet',
                'order'     => 32,
                'color'     => '#2C6FE5',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Phone & Internet',
                    'id'    => 'Telepon & Internet',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108a14-ee84-4def-8479-d74765170b20',
                'slug'      => 'banking',
                'order'     => 33,
                'color'     => '#109029',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Banking',
                    'id'    => 'Perbankan',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108a1c-139c-4262-9953-6a64eedce6e5',
                'slug'      => 'education',
                'order'     => 34,
                'color'     => '#bb1dff',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Education',
                    'id'    => 'Pelajaran',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108a25-79f7-42df-a765-6d4ec996158a',
                'slug'      => 'occupations',
                'order'     => 35,
                'color'     => '#FF4626',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Occupations',
                    'id'    => 'Pekerjaan',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108a2d-a79b-4aea-9f48-cd0c4799e0ca',
                'slug'      => 'business-talk',
                'order'     => 36,
                'color'     => '#B86539',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Business Talk',
                    'id'    => 'Pembicaraan Bisnis',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108a38-276d-480e-8f84-26ace8e7386a',
                'slug'      => 'sports',
                'order'     => 37,
                'color'     => '#f75255',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Sports',
                    'id'    => 'Olahraga',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108a42-950a-417e-8b4c-0548567da09d',
                'slug'      => 'countries',
                'order'     => 38,
                'color'     => '#0086ff',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Countries',
                    'id'    => 'Negara',
                    'vi'    => null
                ])
            ),
            array(
                'id'        => '97108a4c-c9a8-43ca-8c19-7edbb62defe9',
                'slug'      => 'others',
                'order'     => 39,
                'color'     => '#4c4357',
                'icon_name' => null,
                'icon_type' => null,
                'image_url' => null,
                'name'      => json_encode([
                    'en'    => 'Others',
                    'id'    => 'Lain-lain',
                    'vi'    => null
                ])
            ),
        );
        DB::table($this->tableName)->insert($categories);
    }
}
