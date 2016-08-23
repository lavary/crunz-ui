<?php

namespace App;

class TaskBuilder {
 
    /**
     * Task model
     *
     * @var \stdClass
     */
    protected $task;

    /**
     * The Crunz event
     *
     * @var \Crunz\Event
     */
    protected $event;

    /**
     * Instantiate the task builder
     *
     * @param \StdClass    $task
     * @param \Crunz\Event $event
     */
    public function __construct($task, \Crunz\Event $event)
    {
        $this->task  = $task;
        $this->event = $event;
    }

    /**
     * Process a task into a Crunz\Event object
     *
     */
     public function generate()
     {        
        $this->event->description($this->task->description);

         // Set current working directory
        if ($this->task->run_in) {
            $this->event->in($this->task->run_in);
        }

        // If prevent overlapping is set
        if ($this->task->prevent_overlapping) {
            $this->event->preventOverlapping();
        }

        // If event has a dedicated log file
        if ($this->task->output_log) {
            $this->event->appendOutputTo($this->task->output_log);
        }

        //Since we have different method for setting the frequency of execution
        //we check whether user has set custom or the preset frequency.
        //First, we check if it's a custom frequency which consists of unit time and value
        if ($this->task->unit_key && $this->task->unit_value) {
            $this->event->every($this->task->unit_key, $this->task->unit_value);
        } 

        //Then we check if it's a quick one, if it is, we call the respective
        //method
        else if ($this->task->preset_freq) {
            $this->frequency($this->task->preset_freq);
        }

        //This will set the execution time for preset and custom frequencies
        //This will be ignored when the selected unit of time is hour or minute 
        if ($this->task->run_at) {
            $this->event->at($this->task->run_at);
        }

        //If the day of week is provided, we call the respective method
        //This will set the day of week field of the final cron expression
        //This only works tasks with a frequency exection and not one-off tasks
        if ($this->task->day_of_week) {
            $this->dayOfWeek($this->task->day_of_week);
        }

        
        //If the cron expression has been directly set by the user,
        //we set the expression directly. This has priority over preset
        //and custom frequencies and will ignore day of week if it's already been set
        if ($this->task->cron_expression) {
            $this->event->cron($this->task->cron_expression);
        }

        //Setting the run date for one-off tasks
        //This will override any prior settings.
        if ($this->task->run_date) {
            $this->event->on($this->task->run_date);
        }

        //Since it's not easy to set activation time for a task in a traditional
        //crontab file, we set the up time and the sleep time as callback functions
        if ($this->task->up_date || $this->task->up_time || $this->task->sleep_date || $this->task->sleep_time) {
            $this->lifetime(
                $this->task->up_date,
                $this->task->up_time,
                $this->task->sleep_date,
                $this->task->sleep_time
            );
        }

        //Pinging the urls before the execution
        if ($this->task->ping_before) {
            $this->pingBefore($this->task->ping_before);
        }

        //Pinging the urls after a successfull execution
        if ($this->task->ping_after) {
            $this->thenPing($this->task->ping_after);
        }
     }

    /**
     * Set the task's activation time
     *
     * @param string $up_date
    *  @param string $up_time
     * @param string $sleep_date
     * @param string $sleep_time
     */
    public function lifetime($up_date, $up_time, $sleep_date, $sleep_time)
    {
        if ($up_date || $up_time) {
            $this->event->from($up_date, $up_time);
        }

        if ($sleep_date || $sleep_time) {
            $this->event->to($sleep_date, $sleep_time);
        }

        return $this;
    }

    /**
     * Set the task's uptime
     *
     * @param string $date
     * @param string $time
     */
    protected function from($date, $time)
    {
        $this->event->from($this->normalizeDate($date, $time));
    }

    /**
     * Set the task's sleep time
     *
     * @param string $date
     * @param string $time
     */
    protected function to($date, $time)
    {
        $this->event->to($this->normalizeDate($date, $time));
    }

    /**
     * Concatenate the date and time
     *
     * @param  string $date
    *  @param  string $time
     * @return $this
     */
    protected function normalizeDate($date, $time)
    {
        return $date . ($date && $time) ? ' ' : '' . $time;
    }

    /**
     * Set a preset frequency for the tasks
     *
     * @param  string $frequency
     * @return $this
     */
    protected function frequency($frequency = null)
    {
        return $this->callMethod($frequency);
    }

    /**
     * Set the day of week for the task
     *
     * @param  string $weekday
     * @return $this
     */
    protected function dayOfWeek($daysOfWeek = null)
    {
        if ($daysOfWeek == 'weekdays') {
            $this->event->weekdays();
        } else {
            $this->event->dayOfWeek($daysOfWeek);
        }

        return $this;
    
    }

    /**
     * ping URLs before the execution
     *
     * @param  string $ping_urls
     * @return $this
     */
    protected function pingBefore($ping_urls)
    {
        foreach (explode(';', $ping_urls) as $url) {
            $this->event->pingBefore(trim($url));
        }

        return $this;
    }

    /**
     * Ping URLs after a succuessfull execution
     *
     * @param  string $ping_urls
     * @return $this
     */
    protected function thenPing($ping_urls)
    {
        foreach (explode(';', $ping_urls) as $url) {
            $this->event->thenPing(trim($url));
        }

        return $this;
    }

    /**
     * Call a method from the Event object
     *
     * @param  string $method
     * @return $this
     */
    protected function callMethod($method)
    {                    
        if (!method_exists($this->event, $method)) {
            throw new \BadMethodCallException("Method <strong>{$method}</strong> does not exist!");
        } 

        call_user_func([$this->event, $method]);
        
        return $this;  
    }

}