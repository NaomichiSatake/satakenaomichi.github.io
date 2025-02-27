<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            [
                'name' => 'Machines',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Movies',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Lifestyle',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Foods',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Study',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Videoame',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
        ];

        $this->category->insert($categories);
    }
}
