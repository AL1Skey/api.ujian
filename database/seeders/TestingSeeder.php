<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Factories\TestingFactory;

class TestingSeeder extends Seeder
{
    public function run(): void
    {
        $factory = new TestingFactory();
        $factory->generateAll(10); // Buat 10 data tiap jenis
    }
}

