<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer',
            'name' => 'required|max:100',
            'description' => 'required|max:200',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();

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
