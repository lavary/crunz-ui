<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;
use DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(config('view.list_per_page'));
        return view('index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        return view('create', ['task' => $task]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules());   
               
        Task::create($request->all());
        
        return redirect()->route('tasks.index')
                         ->with('success', 'Task was created succussfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        
        if(!$task) {
            abort(404);
        }

        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$this->validate($request, $this->rules());

        $task = Task::find($id);

        if(!$task) {
            abort(404);
        }

        $fields = $request->all();        
        foreach ($fields as $key => $value) {
            if (array_key_exists($key, $task->getAttributes())) {
                $task->$key = $value;
            }
        }

        $task->save();

        return redirect()->route('tasks.edit', $id)
                         ->with('success', 'Task was updated succussfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        if (!is_null($id)) {
            Task::destroy($id);
        } else {
            Task::destroy($request->get('list'));
        }    
        
        return redirect()->route('tasks.index')
                         ->with('warning', 'The selected task(s) removed successfully.');
    }

    /**
     * Toggle tsk activation status
     *
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request)
    {
        
        DB::table('tasks')->whereIn('id', $request->get('list'))
                          ->update(['active' => DB::raw('NOT active')]);

        return redirect()->route('tasks.index')
                         ->with('success', 'The status applied successfully.');
    }

    /**
     * Return validation rules for this controller
     *
     * @return array
     */
    public function rules()
    {
        return [            
            'name'        => 'required',
            'unit_value'  => 'numeric|required_with:unit_key',
            'unit_key'    => 'required_with:unit_value',
            'run_at'      => 'date_format:H:m',
            'run_date'    => 'date_format:Y/m/d H:m',
            'up_date'     => 'date_format:Y/m/d',
            'up_time'     => 'date_format:H:m',
            'sleep_date'  => 'date_format:Y/m/d',
            'sleep_time'  => 'date_format:H:m',
            'run'         => 'required',
            'ping_url'    => 'url'  
        ];
    }
}
