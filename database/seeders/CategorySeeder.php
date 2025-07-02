<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds for categories.
     *
     * This method creates the initial set of categories and subcategories in the database.
     * It creates three main categories (Electronics, Clothing, and Books) and two
     * subcategories under Electronics (Smartphones and Laptops). These categories
     * can be used to organize products in the application.
     *
     * @return void
     */
    public function run(): void
    {
        // Create main categories
        $electronics = Category::create(['name' => 'Electronics']);
        $clothing = Category::create(['name' => 'Clothing']);
        $books = Category::create(['name' => 'Books']);

        // Create subcategories
        Category::create([
            'name' => 'Smartphones',
            'parent_id' => $electronics->id
        ]);

        Category::create([
            'name' => 'Laptops',
            'parent_id' => $electronics->id
        ]);
    }
}
