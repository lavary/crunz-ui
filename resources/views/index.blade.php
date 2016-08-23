@extends('layouts.base')
@section('title', 'Tasks')

@section('page_title')
    <a href="{{route('tasks.create')}}" id="new-btn" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> New Task</a>
    <h1><i class="glyphicon glyphicon-time"></i> Scheduled Tasks</h1>
@endsection

@section('content')
   
    @include('partials.notifications')
    @if (count($tasks))
    <table id="list-tbl" class="table table-hovered table-striped">
        
        <thead>
            
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Cron Expression</th>
                <th>Type</th>
                <th>Status</th>
                <th>Created at</th>
                <th>&nbsp;</th>
                <th><input select-all="list" type="checkbox"></th>
            </tr>

        </thead>

        <tbody>            
                @foreach ($tasks as $task)
                    <tr>
                        <td><a href="{{route('tasks.edit', $task->id)}}">{{$task->name}}</a></td>
                        <td>{{$task->description}}</td>
                        <td>{{$task->cron()}}</td>
                        <td>{{$task->taskType()}}</td>
                        <td class="td-indicator"><i class="glyphicon glyphicon-time {{$task->active ? 'txt-neph' : 'txt-ali'}}" title="{{$task->active ? 'Task is enabled' : 'Task is disabled'}}"></i></td>
                        <td>{{$task->created_at}}</td>
                        <td class="action-btns">
                            <a href="{{route('tasks.edit', $task->id)}}" class="btn btn-info btn-xs">edit</a>
                            {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                                <button type="submit" class="btn btn-default btn-xs" should-confirm><i class="glyphicon glyphicon-trash txt-ali"></i></button>
                            {!! Form::close() !!}
                        </td>
                        <td>{!! Form::checkbox('list[]', $task->id) !!}</td>
                    </tr>
                @endforeach
        </tbody>

    </table>

    <hr>
    
    <bulk-actions-form actions="actions" csrf-token="csrf_token" items="list[]"></bulk-actions-form>

    {!! $tasks->links() !!}

    @else
        <div class="alert alert-warning">There's no task defined yet!</div>
    @endif

@endsection

@section('js_data')
<script type="text/javascript">
    var actions = [
        
        { label: 'Remove',            url: '{{route('tasks.destroy')}}', method: 'DELETE' },
        { label: 'Toggle Activation', url: '{{route('tasks.toggle')}}' }
        ],
        csrf_token = "{{csrf_token()}}";
</script>
@endsection