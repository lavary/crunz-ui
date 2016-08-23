@extends('layouts.base')
@section('title', 'New Task')

@section('page_title')
    <h1><i class="glyphicon glyphicon-time"></i> New Task</h1>
@endsection

@section('content')

    {!! Form::model($task, ['route' => 'tasks.store', 'method' => 'post']) !!}
        @include('partials.form')
    {!! Form::close() !!}

@endsection