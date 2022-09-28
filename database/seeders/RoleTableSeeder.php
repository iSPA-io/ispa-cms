<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Webmaster',
            'custom' => [
                'text_color' => '#DC2626',
                'badge' => 'danger',
                'icon' => null,
                'image' => null,
                'level' => 0,
            ]
        ]);

        $role->permissions()->sync(range(1, 39));
    }
}
