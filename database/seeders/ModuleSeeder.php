<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'Álgebra y Geometría' => 1,
            'Matemática Discreta' => 1,
            'Fundamentos de Programación I' => 1,
            'Fundamentos de Computadores' => 1,
            'Habilidades Profesionales para Ingenieros' => 1,
            'Matemáticas para la Computación' => 1,
            'Fundamentos Físicos de la Informática' => 1,
            'Fundamentos de Programación I' => 1,
            'Estructura de Computadores' => 1,
            'La Empresa y sus Procesos' => 1,

            'Métodos Estadísticos' => 2,
            'Algoritmos y Programación' => 2,
            'Tecnologías de Programación' => 2,
            'Periféricos e Interfaces' => 2,
            'Ingeniería del Software I' => 2,
            'Métodos Numéricos' => 2,
            'Estructuras de Datos y Programación' => 2,
            'Bases de Datos I' => 2,
            'Arquitectura de Computadores' => 2,
            'Fundamentos de los Sistemas Operativos' => 2,

            'Redes de Computadores' => 3,
            'Administración de Sistemas Operativos' => 3,
            'Bases de Datos II' => 3,
            'Fundamentos de los Sistemas Inteligentes' => 3,
            'Ingeniería del Software II' => 3,
            'Administración de Servicios en Red' => 3,
            'Virtualización y Procesamiento Distribuido' => 3,
            'Programación Web y Móvil' => 3,
            'Producción de Software' => 3,

            'Informática Gráfica' => 4,
            'Sistemas Robóticos Autónomos' => 4,
            'Visión por Computador' => 4,
            'Programación de Aplicaciones Móviles Nativas' => 4,
            'Computación en la Nube' => 4,
            'Internet de las Cosas' => 4,
            'Emprendimiento y Creación de Empresas de Base Tecnológica' => 4,
            'Los Sistemas de Información en la Organización' => 4,
            'Seguridad de la Información' => 4,
            'Proyectos de Ingeniería y Gestión del Software' => 4,
            'Trabajo Fin de Grado ' => 4,
        ];
        foreach ($modules as $module => $academic_year_id) {
            Module::create([
                'name' => $module,
                'academic_year_id' => $academic_year_id,
            ]);
        }
    }
}
