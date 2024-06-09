<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Transportation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);
        User::factory()->create([
            'name' => 'Penjabat Utama',
            'username' => 'penjabat-1',
            'role' => 'penjabat',
            'password' => bcrypt('penjabat'),
        ]);
        User::factory()->create([
            'name' => 'Wakil Penjabat',
            'username' => 'penjabat-2',
            'role' => 'penjabat',
            'password' => bcrypt('penjabat'),
        ]);
        
        // Company
        Company::factory()->create([
            'name' => 'PT Pusat Jaya',
            'address' => 'Jakarta Timur',
            'role_company' => 'Perusahaan Pusat',
        ]);
        Company::factory()->create([
            'name' => 'PT Anakan Satu',
            'address' => 'Surabaya',
            'role_company' => 'Perusahaan Cabang',
        ]);
        Company::factory()->create([
            'name' => 'PT Anakan Dua',
            'address' => 'Malang',
            'role_company' => 'Perusahaan Cabang',
        ]);
        Company::factory()->create([
            'name' => 'PT Berdiri Sendiri',
            'address' => 'Solo',
            'role_company' => 'Perusahaan Kontributor',
        ]);

        // Driver
        Driver::factory()->create([
            'name' => 'Doddy',
            'address' => 'Surakarta',
            'gender' => 'Laki-Laki',
        ]);
        Driver::factory()->create([
            'name' => 'Hermanto Kurniawan',
            'address' => 'Riau',
            'gender' => 'Laki-Laki',
        ]);

        // Transpot
        Transportation::factory()->create([
            'company_id' => 1,
            'name' => 'Truck',
            'product_type' => 'AA09',
            'transportation_type' => 'Kendaraan Berat',
            'fuel' => '25',
        ]);
        Transportation::factory()->create([
            'company_id' => 2,
            'name' => 'Mobil',
            'product_type' => 'BBC5',
            'transportation_type' => 'Kendaraan Sedang',
            'fuel' => '15',
        ]);
        Transportation::factory()->create([
            'company_id' => 3,
            'name' => 'Motor Trail',
            'product_type' => 'JK89',
            'transportation_type' => 'Kendaraan Ringan',
            'fuel' => '3',
            'cost' => '100000',
            'start_date' => '2024-07-13',
            'end_date' => '2024-07-15'
        ]);


        
    }
}
