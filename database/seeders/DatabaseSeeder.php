<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeederTable;
use Database\Seeders\ModuleSeederTable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeederTable::class,
            ModuleSeederTable::class,
        ]);
    }
}
