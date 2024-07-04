<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::with('tasks')->get();
        
        $response = $companies->map(function ($company) {
            return [
                'id' => $company->id,
                'name' => $company->name,
                'tasks' => $company->tasks->map(function ($task) {
                    return [
                        'id' => $task->id,
                        'name' => $task->name,
                        'description' => $task->description,
                        'user' => $task->user->user,
                        'is_completed' => $task->is_completed,
                        'start_at' => $task->start_at,
                        'expired_at' => $task->expired_at,
                    ];
                })
            ];
        });

        return response()->json($response);
    }

    public function show($id)
    {
        $company = Company::with('tasks')->findOrFail($id);
        
        $response = [
            'id' => $company->id,
            'name' => $company->name,
            'tasks' => $company->tasks->map(function ($task) {
                return [
                    'id' => $task->id,
                    'name' => $task->name,
                    'description' => $task->description,
                    'user' => $task->user->user,
                    'is_completed' => $task->is_completed,
                    'start_at' => $task->start_at,
                    'expired_at' => $task->expired_at,
                ];
            })
        ];

        return response()->json($response);
    }

}

