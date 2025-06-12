<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderby('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));

    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|max:255']);
        Task::create(['title' => $request->title]);
        return back();
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Task $task)
    {
        $task->update(['is_done' => !$task->is_done]);
        return back();
    }

}
