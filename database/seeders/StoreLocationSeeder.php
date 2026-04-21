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
            'Ar-Rahman E-Bike Bondowoso',
            'Star E-Bike Bondowoso',
            'Ar-Rahman E-Bike Pujer',
        ])->each(function (string $name): void {
            StoreLocation::updateOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        });
    }
}
