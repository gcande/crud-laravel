<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
// use Symfony\Component\HttpFoundation\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //obtiene todos los datos de Taskt
        $tasks = Task::latest()->paginate(5);        
        return view('index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //mostramos la vista del formulario se sirve para crear la tabla
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //despues de crear la tarea nos dirige al index
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required'
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea creada exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        // dd($task);
        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task):RedirectResponse
    {
        //validacion
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required'
        ]);
        
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea Eliminada exitosamente!');
    }
}
