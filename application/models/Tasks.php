<?php

/**
 * Modified to use REST client to get port data from our server.
 */
define('REST_SERVER', 'http://backend.local');  // the REST server host
define('REST_PORT', $_SERVER['SERVER_PORT']);   // the port you are running the server on

/**
 * Description of Tasks
 *
 * @author steve
 */
class Tasks extends REST_Model 
{        
    public function __construct()
    {
        parent::__construct(APPPATH . '', 'id', 'task');
    }

    function getCategorizedTasks()
    {
        // extract the undone tasks
        foreach ($this->all() as $task)
        {
            if ($task->status != 2)
                $undone[] = $task;
        }

        // substitute the category name, for sorting
        foreach ($undone as $task)
            $task->group = $this->app->group($task->group);

        // order them by category
        usort($undone, "orderByCategory");

        // convert the array of task objects into an array of associative objects       
        foreach ($undone as $task)
            $converted[] = (array) $task;

        return $converted;
    }

    function getCompletedTasks()
    {
        // extract the undone tasks
        foreach ($this->all() as $task)
        {
            if ($task->status == 2)
                $done[] = $task;
        }

        // substitute the category name, for sorting
        foreach ($done as $task)
            $task->group = $this->app->group($task->group);

        // order them by category
        usort($done, "orderByCategory");

        // convert the array of task objects into an array of associative objects       
        foreach ($done as $task)
            $converted[] = (array) $task;

        return $converted;
    }

    // provide form validation rules
    public function rules()
    {
        $config = array(
        ['field' => 'task', 'label' => 'TODO task', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
        ['field' => 'priority', 'label' => 'Priority', 'rules' => 'integer|less_than[4]'],
        ['field' => 'size', 'label' => 'Task size', 'rules' => 'integer|less_than[4]'],
        ['field' => 'group', 'label' => 'Task group', 'rules' => 'integer|less_than[5]'],
        );
        return $config;
    }
}

// return -1, 0, or 1 of $a's category name is earlier, equal to, or later than $b's
function orderByCategory($a, $b)
{
    if ($a->group < $b->group)
        return -1;
    elseif ($a->group > $b->group)
        return 1;
    else
        return 0;
}
