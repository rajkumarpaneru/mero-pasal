<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ["Admin", "Seller", "Customer"];

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name' => $role,
                'slug' => Str::slug($role, '-')
            ], [

            ]);
        }
    }
}
