<?php

namespace App\Controllers;

use App\Models\Task;

class TasksController
{   
    /**
     * Class constructor.
     */
    public function __construct()
    {
        if (!isAuth()) {
            return redirect('/login');
        }
    }

    /**
     * Display the view for the tasks page.
     */
    public function index()
    {
        $tasks = Task::all();
        $error = session('tasks-error');

        return view('tasks', compact('tasks', 'error'));
    }

    /**
     * Create a new task.
     */
    public function store()
    {
        Task::save([
            'description' => request('description'),
            'completed' => false
        ]);

        return redirect('/tasks');
    }

    /**
     * Update the details of the given task.
     */
    public function update()
    {
        $task = Task::findById(request('id'));

        if (count($task) > 0) {
            Task::update([
                'id' => $task[0]->id,
                'description' => request('description'),
                'completed' => request('completed')
            ]);

            return redirect('/tasks');
        }

        session('tasks-error', 'No task found!');
        return redirect('/tasks');
    }

    /**
     * Delete the given task.
     */
    public function destroy()
    {
        $task = Task::findById(request('id'));

        if (count($task) > 0) {
            Task::delete($task);
            return redirect('/tasks');
        }

        session('tasks-error', 'No task found!');
        return redirect('/tasks');
    }
}