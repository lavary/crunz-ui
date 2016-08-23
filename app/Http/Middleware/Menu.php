<?php

namespace App\Http\Middleware;

use Closure;

class Menu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('navlinks', function ($t) {
            
            $t->add('Tasks');
            $t->tasks->add('Scheduled Tasks', ['route' => 'tasks.index']);
            $t->tasks->add('New Task',        ['route' => 'tasks.create']);

        }); 
               
        return $next($request);
    }
}
