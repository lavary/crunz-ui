<div class="col-md-5">
        
        @include('partials.notifications')

        <div class="col-md-10">
            
            <div class="form-group @if($errors->has('name')) has-error @endif">
                <label class="control-label">Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                    {!! Form::text('name', $task->name, ['class' => 'form-control', 'placeholder' => 'Short description']) !!}
                </div>
            </div>

            <hr>

            <div class="form-group @if($errors->has('preset_freq')) has-error @endif">
                <label class="control-label">Preset Frequency</label>
                <div id="quick-inline" class="form-inline">
                    
                    {!! Form::select('preset_freq', array(
                        
                        ''          => 'Select',
                        'hourly'    => 'Hourly',
                        'daily'     => 'Daily',
                        'weekly'    => 'Weekly',
                        'quarterly' => 'Quarterly',
                        'yearly'    => 'Yearly',

                        ),
                        $task->preset_freq,
                        array('class' => 'form-control'))
                    !!}                    

                </div>
            </div>

            <div class="form-group @if($errors->has('unit_key') || $errors->has('unit_value')) has-error @endif">
                <label class="control-label">Custom Frequency</label>
                <div id="custom-inline" class="form-inline">
                    <div class="badge">Every</div>

                    {!! Form::text('unit_value', $task->unit_value, ['class' => 'form-control', 'placeholder' => 'Digit']) !!}
                    
                    {!! Form::select('unit_key', array(
                        
                        ''          => 'Select',
                        'minute'    => 'Minute(s)',
                        'hour'      => 'Hour(s)',
                        'day'       => 'Day(s)',
                        'month'     => 'Month(s)',

                        ),
                        $task->unit_key,
                        array('class' => 'form-control'))
                    !!} 

                </div><!--/form-inline-->
                <div class="help-block">This will override <strong>Preset Frequency</strong></div>
            </div>

            <div class="form-group @if($errors->has('run_at')) has-error @endif">
                <label class="control-label">Run At</label>
                <div class="input-group col-md-6">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    {!! Form::text('run_at', $task->run_at, ['class' => 'form-control', 'time-picker', 'placeholder' => 'HH:mm']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Day of week</label>
                {!! Form::select('day_of_week[]', array(
                        
                    'weekdays' => 'Weekdays',
                    'mon'      => 'Mondays',
                    'tue'      => 'Tuesdays',
                    'wed'      => 'Wednesdays',
                    'thu'      => 'Thursdays',
                    'fri'      => 'Fridays',
                    'sat'      => 'Saturdays',
                    'sun'      => 'Sundays',
                    ),
                    explode(',', $task->day_of_week),
                    array('class' => 'form-control', 'multiple'))
                !!} 
                <p class="help-block"><em>Select a week day if you want to run your task on a certain day of the week.</em></p> 
            </div>

             <hr>

             <div class="form-group">
                <label class="control-label">Cron Expression</label>
                <div class="input-group col-md-8">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                    {!! Form::text('cron_expression', $task->cron_expression, ['class' => 'form-control', 'placeholder' => 'Cron Expression']) !!}
                </div>
                <div class="help-block">This will override all previously defined frequency settings.</div>
            </div>

            <hr>

            <div class="form-group">
                <label class="control-label">Description</label>
                {!! Form::textarea('description', $task->description, ['class' => 'form-control', 'placeholder' => 'A short description of what the task does', 'rows' => 3]) !!}
            </div>

            <hr>

            <div class="form-group @if($errors->has('run_date')) has-error @endif">
                <label class="control-label">Run Date</label>
                <div class="input-group col-md-8">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    {!! Form::text('run_date', $task->run_date, ['class' => 'form-control', 'date-time-picker', 'placeholder' => 'YYYY/MM/DD HH:mm']) !!}
                </div>
                <p class="help-block"><em>When this field has value, all previous frequency settings will be ignored.</em></p>
            </div>

            <hr>

            <div class="form-group @if($errors->has('up_date') || $errors->has('up_time')) has-error @endif">
                <label class="control-label">Wake Up On</label>
                <div class="form-inline">
                    <div class="input-group col-md-5">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        {!! Form::text('up_date', $task->up_date, ['class' => 'form-control', 'date-picker', 'placeholder' => 'YYYY/MM/DD']) !!}
                    </div> 
                    <div class="input-group col-md-4">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        {!! Form::text('up_time', $task->up_time, ['class' => 'form-control', 'time-picker', 'placeholder' => 'HH:mm']) !!}
                    </div>       
                </div>   
            </div>

            <div class="form-group @if($errors->has('sleep_date') || $errors->has('sleep_time')) has-error @endif">
                <label class="control-label">Sleep On</label>
                <div class="form-inline">
                    <div class="input-group col-md-5">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        {!! Form::text('sleep_date', $task->sleep_date, ['class' => 'form-control', 'date-picker', 'placeholder' => 'YYYY/MM/DD']) !!}
                    </div>
                    <div class="input-group col-md-4">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        {!! Form::text('sleep_time', $task->sleep_time, ['class' => 'form-control', 'time-picker', 'placeholder' => 'HH:mm']) !!}
                    </div>   
                </div>              
            </div>

        </div>  
    </div><!--col-md-6-->
    <div class="col-md-7">
        
        <div class="form-group @if($errors->has('run_in')) has-error @endif">
            <label class="control-label">Current Working Directory</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
                {!! Form::text('run_in', $task->run_in, ['class' => 'form-control', 'placeholder' => '/path/to/the/sript/or/command/directory']) !!}
            </div>
        </div>

        <div class="form-group">
            <label></label>
            <div class="panel panel-green">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-console"></i> Command</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
{!! Form::textarea('run',
'&lt;?php
// A callback function
function(){
    // Your code here
}
?&gt;

// A linux command
cp app app_backup

// Or just a script
php app.php',
['class' => 'form-control', 'php-code', 'rows' => 10])
!!}    
                    </div>
                </div>
            </div><!--/panel-->
            </div><!--/form-group-->

            <hr>
            
            <div class="form-group @if($errors->has('ping_before')) has-error @endif">
                <label class="control-label">Ping Before</label>
                {!! Form::text('ping_before', $task->ping_before, ['class' => 'form-control', 'placeholder' => 'http://url/to/pig']) !!}
            </div>

            <div class="form-group @if($errors->has('ping_after')) has-error @endif">
                <label class="control-label">Ping After</label>
                {!! Form::text('ping_after', $task->ping_after, ['class' => 'form-control', 'placeholder' => 'http://url/to/pig']) !!}
                <p class="help-block"><em>You can add several URLs by separating them with a semi-colon</em></p>
            </div>

            <div class="form-group @if($errors->has('output_log')) has-error @endif">
                <label class="control-label">Output Log</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                    {!! Form::text('output_log', $task->output_log, ['class' => 'form-control', 'placeholder' => '/path/to/the/log/file']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('prevent_overlapping', 1, $task->prevent_overlapping) !!} Prevent Overlapping
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('active', 1, $task->active) !!} Task is <strong>active</strong>
                    </label>
                </div>
            </div>
            <button class="btn btn-primary btn-lg">Save Task</button>

    </div><!--col-md-6-->