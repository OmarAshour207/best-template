<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            'about', 'services', 'projects', 'blogs', 'doctors', 'contact-us'
        ];

        for ($i = 0; $i < count($pages); $i++) {
            \App\Page::create([
                'slug'  => $pages[$i],
                'title' => [
                    'ar'    => $pages[$i] . ' Title',
                    'en'    => $pages[$i] . 'عنوان'
                ],
                'description'   => [
                    'ar'        => $pages[$i] . ' Description',
                    'en'        => $pages[$i] . ' وصف'
                ],
            ]);
        }

    }
}
