<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;

class ApiController extends Controller
{
    public function tasks()
    {
        $tasks = Task::whereActive(true)->get()
                 ->toArray();
        
        return response()->json($tasks);
    }
}
