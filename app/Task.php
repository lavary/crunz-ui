<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Crunz\Schedule;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Return the cron expression
     *
     * @var string
     */
    public function cron()
    {
        $sch = new Schedule();

        $e = $sch->run($this->run);
        (new TaskBuilder($this, $e))
        ->generate();

        return $e->getExpression();
    }

    /**
     * Return the task type
     *
     * @var string
     */
    public function taskType()
    {
        if ($this->isClosure()) {
            return 'Closure';
        }

        return 'Command';
    }

    /**
     * Check if the run value is a closure
     *
     * @var boolean
     */
    public function isClosure()
    {
       return is_object($this->run) && ($this->run instanceof \Closure);
    }

    /**
     * Return validation rules for this controller
     *
     */
    
    public static function boot()
    {
        parent::boot();
        static::saving(function($task){            
            foreach ($task->toArray() as $key => $value) {
                if ($value !== 0) {
                    $task->{$key} = empty($value) ? \DB::raw('NULL') : $value;
                }
                if (is_array($value)) {
                    $task->{$key} = implode(',', $value);
                }
            }
        });
    }
   
}
