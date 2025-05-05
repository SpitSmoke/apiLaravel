<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    // GET /api/tasks
     public function index()
    {
        return Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */

    //  POST /api/tasks
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $task = Auth::user()->tasks()->create($data);
        return response()->json($task, 201);
    } 

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    
    //  PUT /api.task/ {task}
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'title'       => 'string|max:255',
            'description' => 'nullable|string',
            'is_done'     => 'boolean',
        ]);

        $task->update($data);
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */

    // DELETE /api/task/{task}
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $task->delete();

        return response()->noContent();
    }
}
