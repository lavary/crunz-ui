<!DOCTYPE html>
<html ng-app="CrunzUi">
<head>
    <title>Crunz UI - @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/bootstrap-datetimepicker.min.css')}}">
</head>
<body ng-controller="CrunzUiController">

@include('partials.navbar')

<div class="container">
    @yield('page_title')
    {!! Breadcrumbs::render() !!}
    <hr>
    @yield('content')
</div>

@yield('js_data')
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="{{asset('/assets/js/ace.js')}}"></script>
<script src="{{asset('/assets/js/moment.min.js')}}"></script>
<script src="{{asset('/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('/assets/js/jquery.ace.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/bootstrap-confirmation.min.js')}}"></script>
<script src="{{asset('/assets/js/app.js')}}"></script>
<script src="{{asset('/assets/js/controllers.js')}}"></script>
<script src="{{asset('/assets/js/directives.js')}}"></script>
<script src="{{asset('/assets/js/main.js')}}"></script>
@show

</body>
</html>