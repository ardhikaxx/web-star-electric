<?php

namespace Database\Seeders;

use App\Models\StoreLocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoreLocationSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            'Ar-Rahman Sepeda Listrik Bondowoso',
            'NUV Sepeda Listrik Bondowoso',
            'Ar-Rahman Sepeda Listrik Pujer',
            'Saige Sepeda Listrik Bondowoso',
        ])->each(function (string $name): void {
            StoreLocation::updateOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        });
    }
}
