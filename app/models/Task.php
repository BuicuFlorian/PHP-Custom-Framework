<?php

namespace App\Models;

use App\Core\App;
use App\Core\Database\BaseModel;

class Task extends BaseModel
{   
    static protected $table = 'tasks';
    static protected $columns = ['id', 'description', 'completed', 'user_id'];

    public $id;
    public $description;
    public $completed;
    public $user_id;

    /**
     * Class constructor.
     * 
     * @param array $args
     */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->completed = $args['completed'] ?? false;
        $this->user_id = $args['user_id'] ?? session()->user_id;
    }

    /**
     * Get all tasks that belongs to the authenticated user.
     * 
     * @return array $tasks
     */
    public function all()
    {
        $tasks = App::get('database')->find('tasks', ['user_id' => session()->user_id]);

        // results into objects
        $object_array = [];

        foreach ($tasks as $task) {
            $object_array[] = static::instantiate($task);
        }

        return $object_array;
    }
}
