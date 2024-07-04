<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use App\Rules\TaskRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'company_id' => 'required|integer', 
        'name' => 'required|string',
        'description' => 'required|string',
        'user_id' => 'required|integer',
    ]);

    $user_id = $validatedData['user_id'];
    $pendingTasksCount = Task::where('user_id', $user_id)->where('is_completed', false)->count();

    if ($pendingTasksCount >= 5) {
        return response()->json(['error' => 'No se pueden crear más de 5 tareas pendientes por usuario.'], 400);
    }
    
    $task = Task::create($validatedData);

    $response = [
        'id' => $task->id,
        'name' => $task->name,
        'description' => $task->description,
        'user' => $task->user->user, 
        'company' => [
            'id' => $task->company->id,
            'name' => $task->company->name,
        ],
    ];
    
    return response()->json($response);
}
        
}
