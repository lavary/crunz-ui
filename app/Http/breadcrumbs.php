<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'));
});

// Tasks
Breadcrumbs::register('tasks.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tasks', route('tasks.index'));
});

// New task
Breadcrumbs::register('tasks.create', function($breadcrumbs)
{
    $breadcrumbs->parent('tasks.index');
    $breadcrumbs->push('New task', route('tasks.create'));
});

// Edit task
Breadcrumbs::register('tasks.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('tasks.index');
    $breadcrumbs->push('Edit task', route('tasks.edit', ['tasks' => -1]));
});
