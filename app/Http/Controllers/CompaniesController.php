<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index(){
        
        $companies = Company::with(['tasks' => function($query) {
            $query->select('id', 'name', 'description', 'is_completed','start_at','expired_at','user_id', 'company_id')
            ->with(['user:id,user']);
        }])->select('id', 'name')->get();
        
        $data = [
            'companies' => $companies,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
