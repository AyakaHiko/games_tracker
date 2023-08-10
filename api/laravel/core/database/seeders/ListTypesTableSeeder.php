<?php

namespace Database\Seeders;

use App\Models\ListType;
use Illuminate\Database\Seeder;

class ListTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listTypes = ['Custom', 'Wishlist', 'Completed', 'Uncompleted'];

        foreach ($listTypes as $typeName) {
            ListType::create(['name' => $typeName]);
        }
    }
}
