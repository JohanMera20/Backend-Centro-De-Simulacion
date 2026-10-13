<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Usser;
use App\Models\Ambiente;
use App\Models\Servicio;
use App\Models\Equipo;
use App\Models\Insumo;
use App\Models\Simulacion;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('nombre_rol', 'Administrador')->value('id');
        $instructor = Role::where('nombre_rol', 'Instructor')->value('id');
        $aprendiz = Role::where('nombre_rol', 'Aprendiz')->value('id');

        $usuarios = [
            ['nombre' => 'Admin', 'apellido' => 'Sistema', 'documento' => '1000000001', 'correo' => 'admin@sena.edu.co', 'telefono' => '3000000001', 'usuario' => 'admin', 'password' => 'password', 'role_id' => $admin],
            ['nombre' => 'Laura', 'apellido' => 'Gomez', 'documento' => '1000000002', 'correo' => 'instructor@sena.edu.co', 'telefono' => '3000000002', 'usuario' => 'instructor', 'password' => 'password', 'role_id' => $instructor, 'especialidad' => 'Enfermería', 'profesion' => 'Enfermera', 'experiencia' => 8],
            ['nombre' => 'Pedro', 'apellido' => 'Perez', 'documento' => '1000000003', 'correo' => 'aprendiz@sena.edu.co', 'telefono' => '3000000003', 'usuario' => 'aprendiz', 'password' => 'password', 'role_id' => $aprendiz, 'ficha' => '2754321', 'programa' => 'Tecnología en Enfermería', 'trimestre' => 4],
        ];

        foreach ($usuarios as $u) {
            Usser::firstOrCreate(['correo' => $u['correo']], array_merge($u, ['password' => Hash::make($u['password'])]));
        }

        $ambientes = [
            ['nombre' => 'Laboratorio 201', 'ubicacion' => 'Piso 2'],
            ['nombre' => 'Laboratorio 202', 'ubicacion' => 'Piso 2'],
            ['nombre' => 'Aula 101', 'ubicacion' => 'Piso 1'],
        ];
        foreach ($ambientes as $a) {
            Ambiente::firstOrCreate(['nombre' => $a['nombre']], $a);
        }
        $lab201 = Ambiente::where('nombre', 'Laboratorio 201')->value('id');
        $lab202 = Ambiente::where('nombre', 'Laboratorio 202')->value('id');

        $servicios = [
            ['nombre' => 'Signos Vitales', 'descripcion' => 'Medición y control de signos vitales'],
            ['nombre' => 'Farmacia', 'descripcion' => 'Administración y control de medicamentos'],
            ['nombre' => 'RCP', 'descripcion' => 'Reanimación cardiopulmonar'],
            ['nombre' => 'Venopunción', 'descripcion' => 'Canulación y manejo de accesos venosos'],
            ['nombre' => 'Curaciones', 'descripcion' => 'Curación y cuidado de heridas'],
        ];
        foreach ($servicios as $s) {
            Servicio::firstOrCreate(['nombre' => $s['nombre']], $s);
        }
        $idSignos = Servicio::where('nombre', 'Signos Vitales')->value('id');
        $idRcp = Servicio::where('nombre', 'RCP')->value('id');

        $equipos = [
            ['nombre' => 'Estetoscopio', 'serial' => 'EST-001', 'ambiente_id' => $lab201],
            ['nombre' => 'Tensiómetro', 'serial' => 'TEN-001', 'ambiente_id' => $lab201],
            ['nombre' => 'Desfibrilador', 'serial' => 'DES-001', 'ambiente_id' => $lab202],
            ['nombre' => 'Monitor de signos vitales', 'serial' => 'MON-001', 'ambiente_id' => $lab202],
        ];
        foreach ($equipos as $e) {
            Equipo::firstOrCreate(['serial' => $e['serial']], $e);
        }

        $insumos = [
            ['nombre' => 'Guantes de nitrilo', 'cantidad' => 500, 'ambiente_id' => $lab201],
            ['nombre' => 'Jeringas 5ml', 'cantidad' => 200, 'ambiente_id' => $lab201],
            ['nombre' => 'Gasas esterilizadas', 'cantidad' => 800, 'ambiente_id' => $lab202],
            ['nombre' => 'Suero fisiológico', 'cantidad' => 120, 'ambiente_id' => $lab202],
        ];
        foreach ($insumos as $i) {
            Insumo::firstOrCreate(['nombre' => $i['nombre']], $i);
        }

        $simulaciones = [
            ['nombre' => 'Paro cardiorrespiratorio', 'descripcion' => 'Rescate de paciente en paro con uso del desfibrilador', 'servicio_id' => $idRcp, 'ambiente_id' => $lab202],
            ['nombre' => 'Toma de signos vitales', 'descripcion' => 'Práctica de tensión arterial, frecuencia cardíaca y temperatura', 'servicio_id' => $idSignos, 'ambiente_id' => $lab201],
        ];
        foreach ($simulaciones as $s) {
            Simulacion::firstOrCreate(['nombre' => $s['nombre']], $s);
        }
    }
}