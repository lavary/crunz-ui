@extends('layouts.base')
@section('title', 'Edit Task')

@section('page_title')
    <h1><i class="glyphicon glyphicon-time"></i> Edit Task</h1>
@endsection

@section('content')
    
    {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put']) !!}
        @include('partials.form')
    {!! Form::close() !!}

@endsection