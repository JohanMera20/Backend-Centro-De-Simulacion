<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nombre_rol' => 'Administrador', 'descripcion' => 'Usuario administrador del sistema'],
            ['nombre_rol' => 'Instructor', 'descripcion' => 'Instructor del centro de simulación'],
            ['nombre_rol' => 'Aprendiz', 'descripcion' => 'Estudiante o aprendiz del SENA'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['nombre_rol' => $role['nombre_rol']], $role);
        }
    }
}