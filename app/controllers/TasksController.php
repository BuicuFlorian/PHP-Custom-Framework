<?php

namespace App\Controllers;

use App\Models\Task;
use App\Core\Validator;
use App\Core\Pagination;

class TasksController
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        if (!session()->isLoggedIn()) {
            return redirect('/login');
        }
    }

    /**
     * Display the view for the tasks page.
     */
    public function index()
    {
        $message = session()->message();
        session()->clearMessage();
        $errors = session()->errors();
        session()->clearErrors();

        $currentPage = request('page') ?? 1;
        $perPage = 10;
        $totalPages = Task::countAll(session()->user_id);
        $pagination = new Pagination($currentPage, $perPage, $totalPages);
        $tasks = Task::paginate($pagination, session()->user_id);

        return view('tasks', compact('tasks', 'message', 'errors', 'pagination'));
    }

    /**
     * Create a new task.
     */
    public function store()
    {
        $validator = new Validator();
        $validator->isEmpty(['description' => request('description')]);
        $validator->isString(['description' => request('description')]);

        if (empty($validator->errors)) {
            $task = new Task(['description' => request('description')]);
            $task->save();
        } else {
            session()->errors($validator->errors);
        }

        session()->message('Your task was successfully created.');
        return redirect('/tasks');
    }

    /**
     * Update the details of the given task.
     */
    public function update()
    {
        $validator = new Validator();
        $validator->isEmpty(['description' => request('description')]);
        $validator->isString(['description' => request('description')]);
        $validator->isEmpty(['completed' => request('completed')]);
        $validator->isString(['completed' => request('completed')]);

        if (empty($validator->errors)) {
            $task = new Task();
            $task = $task->findById(request('id'));

            if (!empty($task)) {
                $updatedTask = new Task([
                'id' => request('id'),
                'description' => request('description'),
                'completed' => request('completed')
            ]);
                $updatedTask->save();

                session()->message('Your task was successfully updated.');
            } else {
                session()->errors(['No task found!']);
            }
        } else {
            session()->errors($validator->errors);
        }
        
        return redirect('/tasks');
    }

    /**
     * Delete the given task.
     */
    public function destroy()
    {
        $task = new Task();
        $task = $task->findById(request('id'));

        if (!empty($task)) {
            $task->delete(request('id'));

            session()->message('Your task was successfully deleted.');
            return redirect('/tasks');
        }

        session()->errors(['No task found!']);
        return redirect('/tasks');
    }
}
