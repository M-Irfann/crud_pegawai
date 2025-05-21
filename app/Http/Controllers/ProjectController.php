<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // no 1
    // public function index(){
    //     $tasks = Task::with([
    //         'project'
            
    //     ])->get();

    //     foreach ($tasks as $task) {
    //         echo "Task: {$task->title} <br>";
    //         echo "Project: {$task->project->name} <br>";
    //         // echo "Employees:<br>";
    //         // foreach ($task->employees as $emp) {
    //         //     echo "- {$emp->name} (Dept: " . ($emp->department->name ?? 'N/A') . ")<br>";
    //         // }
    //         echo "<hr>";
    //     }
    // }

    // no 2
    public function index(){
        // $tasks = Task::all();
        $tasks = Task::with([
            'employees'
            ])->get();
        // dd($tasks);

        foreach ($tasks as $task) {
            echo "Task: {$task->title} <br>";
            // echo "Project: {$task->project->name} <br>";
            // echo "Employees:<br>";
            foreach ($task->employees as $emp) {
                echo "- {$emp->name} <br>";
            }
            echo "<hr>";
        }
    }
}
