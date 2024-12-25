<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $colors = [
            'Red', 'Blue', 'Green', 'Yellow', 'Black', 'White',
            'Gray', 'Purple', 'Orange', 'Pink', 'Brown', 'Cyan',
            'Magenta', 'Beige', 'Ivory', 'Turquoise', 'Teal',
            'Gold', 'Silver', 'Lavender', 'Maroon', 'Navy', 
            'Olive', 'Coral', 'Salmon', 'Chocolate', 'Crimson', 
            'Indigo', 'Violet', 'Mint', 'Lime', 'Peach'
        ];

        foreach ($colors as $color) {
            Color::create([
                'name' => $color,
            ]);
        }
    }
}
