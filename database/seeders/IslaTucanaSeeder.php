<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IslaTucana;
class IslaTucanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $islaTucana = new IslaTucana();
        $islaTucana->concept = "desert";
        $islaTucana->quantity = 8;
        $islaTucana->save();
        $islaTucana = new IslaTucana();
        $islaTucana->concept = "forest";
        $islaTucana->quantity = 7;
        $islaTucana->save();
        $islaTucana = new IslaTucana();
        $islaTucana->concept = "mountain";
        $islaTucana->quantity = 6;
        $islaTucana->save();
        $islaTucana = new IslaTucana();
        $islaTucana->concept = "water";
        $islaTucana->quantity = 4;
        $islaTucana->save();
        $islaTucana = new IslaTucana();
        $islaTucana->concept = "wildcard";
        $islaTucana->quantity = 2;
        $islaTucana->save();

    }
}
