<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query =Task::with('list')->whereHas('list', function ($query){
            $query->where('user_id', auth()->id());

        })->orderBy('created_at', 'desc');

        if(request('search')) {
           $search= request('search');
           $query->where(function($q) use ($search){
            $q->where('title', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%");
           });
        }
        if(request()->has('fillter')&& request('fillter') !== 'all'){
            $query->where('is_completed', request('fillter')=== 'completed');
        }
        $tasks =$query->paginate(10);
        $lists = TaskList::where('user_id', auth()->id())->get();
        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks,
            'lists' => $lists,
            'filters' => request()->all(['search', 'fillter']),
            'falsh' => [
                'success' => session('success'),
                'error' => session('error'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'is_completed' => 'boolean',
            'list_id' => 'required|exists:task_lists,id',
        ]);
        Task::create($validated);
        return redirect()->back()->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'is_completed' => 'boolean',
            'list_id' => 'required|exists:task_lists,id',
        ]);
        $task->update($validated);
        return redirect()->back()->with('success', 'Task created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
   
    {
        
        $task->delete();
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
