<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummySeeder extends Seeder
{
    /**
     * Jalankan database seed.
     */
    public function run(): void
    {
        // Matikan foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Truncate tabel dari anak ke induk (pivot -> child -> parent)
        DB::table('assignments')->truncate();
        DB::table('tasks')->truncate();
        DB::table('employees')->truncate();
        DB::table('departments')->truncate();
        DB::table('projects')->truncate();

        // Nyalakan lagi foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Buat data dummy
        $faker = \Faker\Factory::create();

        // Buat 3 Departemen
        $departments = collect();
        for ($i = 0; $i < 3; $i++) {
            $departments->push(Department::create([
                'name' => $faker->company
            ]));
        }

        // Buat 10 Karyawan
        $employees = collect();
        for ($i = 0; $i < 10; $i++) {
            $employees->push(Employee::create([
                'name' => $faker->name,
                'department_id' => $departments->random()->id
            ]));
        }

        // Buat 5 Proyek
        $projects = collect();
        for ($i = 0; $i < 5; $i++) {
            $projects->push(Project::create([
                'name' => $faker->bs
            ]));
        }

        // Buat 15 Tugas
        for ($i = 0; $i < 15; $i++) {
            $task = Task::create([
                'title' => $faker->sentence(3),
                'project_id' => $projects->random()->id
            ]);

            // Assign 1-3 karyawan ke setiap task
            $task->employees()->attach($employees->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
