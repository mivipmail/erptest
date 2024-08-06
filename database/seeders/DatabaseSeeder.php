<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ParentPart;
use App\Models\Part;
use App\Models\Source;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sources = ['Производство', 'Склад'];


        $parts = [
            [ 'id' => 1, 'title' => 'Ultra-1.0-01.00.01 Профиль основной задний',  'qty' => 1, 'source_id' => 1, 'laser' => 3, 'welding' => null, 'assembling' => null, 'electro' => null, 'order_idx' => 1 ],
            [ 'id' => 2, 'title' => 'Ultra-1.0-01.00.04 Ухо', 'qty' => 50, 'source_id' => 1, 'laser' => 4, 'welding' => null, 'assembling' => null, 'electro' => null, 'order_idx' => 2 ],
            [ 'id' => 3, 'title' => 'Ultra-1.0-01.00.08 Втулка подшипников', 'qty' => 2, 'source_id' => 2, 'laser' => null, 'welding' => null, 'assembling' => null, 'electro' => null, 'order_idx' => 3 ],
            [ 'id' => 4, 'title' => 'Болт М6х12 ГОСТ 1231-78', 'qty' => 30, 'source_id' => 2, 'laser' => 4, 'welding' => null, 'assembling' => null, 'electro' => null, 'order_idx' => 4 ],
            
            [ 'id' => 5, 'title' => 'Ultra-1.0-01.00.00 Рама', 'qty' => 1, 'source_id' => 1, 'laser' => null, 'welding' => 800, 'assembling' => 200, 'electro' => 70, 'order_idx' => 5 ],
            [ 'id' => 6, 'title' => 'Ultra-1.0-05.01.00 Рама кресла',  'qty' => 1, 'source_id' => 1, 'laser' => null, 'welding' => 800, 'assembling' => 240, 'electro' => 40, 'order_idx' => 6 ],
            [ 'id' => 7, 'title' => 'Ultra-1.0-00.00.01 Щит', 'qty' => 2, 'source_id' => 1, 'laser' => 4, 'welding' => null, 'assembling' => null, 'electro' => 12, 'order_idx' => 7 ],
            [ 'id' => 8, 'title' => 'ВИТС-3.2-01.00.00 Опора подлокотника', 'qty' => 2, 'source_id' => 1, 'laser' => null, 'welding' => 200, 'assembling' => 120, 'electro' => 10, 'order_idx' => 8 ],
            [ 'id' => 9, 'title' => 'ВИТС-3.2-00.00.00 Коляска-трансформер', 'qty' => 1, 'source_id' => 1, 'laser' => null, 'welding' => null, 'assembling' => null, 'electro' => 300, 'order_idx' => 9 ],
        ];


        $composed = [
            ['parent_id' => 5, 'part_id' => 1, 'qty' => 1,],
            ['parent_id' => 5, 'part_id' => 2, 'qty' => 2,],
            ['parent_id' => 5, 'part_id' => 3, 'qty' => 2,],

            ['parent_id' => 6, 'part_id' => 1, 'qty' => 1,],
            ['parent_id' => 6, 'part_id' => 2, 'qty' => 2,],
            ['parent_id' => 6, 'part_id' => 3, 'qty' => 2,],
            ['parent_id' => 6, 'part_id' => 4, 'qty' => 8,],

            ['parent_id' => 8, 'part_id' => 2, 'qty' => 5,],
            ['parent_id' => 8, 'part_id' => 4, 'qty' => 20,],

            ['parent_id' => 9, 'part_id' => 1, 'qty' => 5,],
            ['parent_id' => 9, 'part_id' => 4, 'qty' => 20,],
        ];

        foreach ($sources as $source)
            Source::create(['title' => $source]);

        foreach ($parts as $part)
            Part::firstOrCreate($part);

        foreach ($composed as $item)
            ParentPart::firstOrCreate($item);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
