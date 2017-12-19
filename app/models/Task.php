<?php

namespace App\Models;

use App\Core\App;

class Task
{
    /**
     * Insert the given task into the tasks table.
     * 
     * @param  array $task
     */
    public function save($task)
    {
        App::get('database')->insert('tasks', $task);
    }

    /**
     * Fetch all tasks from the task table.
     * 
     * @return array $tasks
     */
    public function all()
    {
        return App::get('database')->selectAll('tasks');
    }

    /**
     * Update the details of the given tasks into task table.
     * 
     * @param  array $task
     */
    public function update($task)
    {
        App::get('database')->update('tasks', $task);
    }

    /**
     * Remove the given task from the tasks table.
     * 
     * @param  array $task
     */
    public function delete($task)
    {
        App::get('database')->delete('tasks', $task[0]->id);
    }

    /**
     * Get a task from the tasks table by it's id.
     * 
     * @param  string $id
     * @return array $task
     */
    public function findById($id)
    {
        return App::get('database')->find('tasks', ['id' => $id]);
    }
}
