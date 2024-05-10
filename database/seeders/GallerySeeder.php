<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Gallery;
class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gallery  = new Gallery ;
         $gallery->gallery_name="Ahgffgf";
          $gallery->gallery_cover_image="Argfgfghhghfd";
         $gallery->save();
    }
}
